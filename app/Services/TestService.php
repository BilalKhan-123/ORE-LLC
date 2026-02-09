<?php

namespace App\Services;

use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Answer;
use App\Models\Factor;
use App\Models\Option;
use App\Helpers\Helper;
use App\Models\AgeGroup;
use App\Models\Question;
use App\Traits\BaseModel;
// use App\Jobs\TestCompleted;
use App\Models\AnswerResult;
use App\Traits\ApiResponser;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Notifications\TestCompleted;
use Illuminate\Support\Facades\Auth;

class TestService
{
    use ApiResponser, BaseModel;

    public function __construct(private Answer $answerObj, private AnswerResult $answerResultObj, private Question $questionObj, private Option $optionObj, private User $userObj, private Factor $factorObj, private TestResultService $testResultService)
    {
        //
    }

    public function collection(array $inputs)
    {
        $tests = $this->answerObj->getQB()->select('id', 'user_id', 'exam_type', 'start_at', 'completed_at', 'time_taken', 'created_at');

        if (Auth::user()->hasRole(config('site.roles.client'))) {
            $tests = $tests->whereHas('user', function ($q) {
                $q->where('client_id', Auth::user()->id);
            });
        }

        if (Auth::user()->hasRole(config('site.roles.user'))) {
            $tests = $tests->where('user_id', Auth::user()->id);
        }

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $tests->get() : $tests->paginate($inputs['limit']);
    }

    public function resource($params, $inputs = [])
    {
        $answer = $this->answerObj->with('user')->find($params['answer_id']);

        if (! $answer->checkPermission()) {
            $data['errors']['message'] = __('message.invalidAction');

            return $data;
        }

        $questions = $this->questionObj->get();

        $options = $this->optionObj->get();

        foreach ($questions as $key => $question) {
            $answerColumn = (! empty($question->answers_ref_column) ? $question->answers_ref_column : 'question' . $question->id . '_answer_id');
            $quePrefix = explode('_', $answerColumn)[0];

            $questions[$key]['result'] = [
                'answer_id' => $answer->{$answerColumn},
                'time_taken' => $answer->{$quePrefix . '_time_taken'},
            ];
        }
        $factors = $this->answerResultObj->with('factor')->where('answer_id', $params['answer_id'])->get();
        $data['data']['questions'] = $questions;
        $data['data']['options'] = $options;
        $data['data']['factors-explanations'] = $factors;
        $data['data']['answer'] = $answer->only(['id', 'user_id', 'start_at', 'completed_at', 'time_taken', 'user', 'created_at']);

        return $data;
    }

    public function store(array $inputs)
    {
        $auth = auth()->user();

        Log::info('UserId: ' . $auth->id . ', Email: ' . $auth->email . ', Response: ' . json_encode($inputs));

        $answer = [];
        $response = [];

        $timezone = $inputs['timezone'];
        $startAt = (int) $inputs['start_at'];
        $completedAt = (int) $inputs['completed_at'];
        $timeTaken = (int) $inputs['time_taken'];
        $client = $auth->client;
        $answer['timezone'] = $timezone;
        $answer['start_at'] = Carbon::createFromTimestamp($startAt, $timezone)->setTimezone(config('site.timezone'))->format('Y-m-d H:i:s');
        $answer['completed_at'] = Carbon::createFromTimestamp($completedAt, $timezone)->setTimezone(config('site.timezone'))->format('Y-m-d H:i:s');
        $answer['time_taken'] = $timeTaken;

        $questions = Question::query()->get()->toArray();

        $options = Option::query()->get()->toArray();

        $ageGroupId = null;
        if (! empty($auth->birthdate)) {
            $userAge = Helper::getCurrentAge($auth->birthdate);
            $ageGroup = AgeGroup::query()->where('min_age', '<=', $userAge)->where('max_age', '>=', $userAge)->firstOrFail();
            $ageGroupId = $ageGroup->id;
        }

        DB::beginTransaction();

        $answerPointArr = [];
        foreach ($inputs['questions'] as $question) {
            $questionObj = null;
            $optionObj = null;

            $queFilter = array_filter($questions, fn ($item) => $item['id'] == $question['question_id']);
            if (count($queFilter) > 0) {
                $questionObj = (object) $queFilter[array_key_first($queFilter)];
            }
            $optFilter = array_filter($options, fn ($item) => $question['selected_answer_id'] == $item['id']);
            if (count($optFilter) > 0) {
                $optionObj = (object) $optFilter[array_key_first($optFilter)];
            }

            $answerColumn = $questionObj->answers_ref_column ?? "question{$questionObj->id}_answer_id";
            $quePrefix = explode('_', $answerColumn)[0];

            $answer[$answerColumn] = $question['selected_answer_id'];
            $answer[$quePrefix . '_time_taken'] = $question['time_taken'];
            $response[$quePrefix . '_answered_at'] = $question['answered_at'];

            $pointArr = [];
            if ($questionObj->mode == config('site.question_mode.forward')) {
                $pointArr = [
                    'factor1_id' => $questionObj->factor1_id,
                    'factor2_id' => $questionObj->factor2_id,
                    'points' => $optionObj->forward_points,
                ];
            } else {
                $pointArr = [
                    'factor1_id' => $questionObj->factor1_id,
                    'factor2_id' => $questionObj->factor2_id,
                    'points' => $optionObj->backward_points,
                ];
            }

            $answerPointArr[] = $pointArr;
        }

        $answer['score'] = array_sum(array_column($answerPointArr, 'points')) * 2;
        $answer['response'] = json_encode($response);
        $answer['age_group_id'] = $ageGroupId;
        $answer['exam_type'] = $inputs['exam_type'];
        $answer = $this->answerObj->create($answer);
        if (! empty($client)) {
            $this->syncClientMetadata($client, $inputs);
        }
        $this->syncParticipantMetadata($auth, $inputs);

        $factorList = Factor::query();
        $asnwerResult = [];

        foreach ($factorList->get() as $factorItem) {
            $factorRes = json_decode($factorItem->response, true);
            $pointArr = array_filter($answerPointArr, fn ($item) => $item['factor1_id'] == $factorItem->id);
            if (count($pointArr) > 0) {
                $facPoint = array_sum(array_column($pointArr, 'points'));
                $asnwerResult[] = new AnswerResult([
                    'factor_id' => $factorItem->id,
                    'result' => $facPoint,
                ]);

                $factorItem->update([
                    'response' => json_encode([
                        'points' => isset($factorRes['points']) ? ($factorRes['points'] + $facPoint) : $facPoint,
                        'testCount' => ! empty($factorRes['testCount']) ? ($factorRes['testCount'] + 1) : 1,
                    ]),
                ]);
            }

            $pointArr = array_filter($answerPointArr, fn ($item) => $item['factor2_id'] == $factorItem->id);
            if (count($pointArr) > 0) {
                $facPoint = array_sum(array_column($pointArr, 'points'));
                $asnwerResult[] = new AnswerResult([
                    'factor_id' => $factorItem->id,
                    'result' => $facPoint,
                ]);

                $factorItem->update([
                    'response' => json_encode([
                        'points' => isset($factorRes['points']) ? ($factorRes['points'] + $facPoint) : $facPoint,
                        'testCount' => ! empty($factorRes['testCount']) ? ($factorRes['testCount'] + 1) : 1,
                    ]),
                ]);
            }
        }
        $answer->answerResult()->saveMany($asnwerResult);
        DB::commit();

        try {
            $user = Auth::user();

            $answerData = [
                'name' => $answer->user->full_name,
            ];
            $answerData['exam_type'] = $inputs['exam_type'];

            $users = collect();
            $users->push($user);

            // Email code...

            $factorsRequest = ['answer_id' => $answer->id, 'user' => false, 'lang' => 'en'];

            $factorsData = $this->testResultService->resource($factorsRequest);
            $data = $factorsData['data'];
            $data['exam_type'] = $inputs['exam_type'];

            $factorsPdf1 = Pdf::loadView('pdf.individual_factors', compact('data'));
            $factorsPdf2 = Pdf::loadView('pdf.factors', compact('data'));
            $factorsPdf3 = Pdf::loadView('pdf.factor_results', compact('data'));
            $factorsName = strtolower($data['user']->first_name);
            // Email code
            $pdfPath1 = storage_path("app/public/{$factorsName}-individual-factors.pdf");
            $pdfPath2 = storage_path("app/public/{$factorsName}-factors.pdf");
            $pdfPath3 = storage_path("app/public/{$factorsName}-factor-results.pdf");
            $factorsPdf1->save($pdfPath1);
            $factorsPdf2->save($pdfPath2);
            $factorsPdf3->save($pdfPath3);
            $user->notify(new TestCompleted($user, $data, $pdfPath1, $pdfPath2, $pdfPath3));
            // TestCompleted::dispatch($users, $answerData,$pdfPath1,$pdfPath2,$pdfPath3);
        } catch (\Exception $e) {
            Log::warning('Test Completed Notification Error : ' . $e->getMessage());
        }

        $data['test_id'] = $answer->id;
        $data['message'] = __('message.testSuccess');

        return $data;
    }

    public function compare($params, $inputs = [])
    {
        $answers = $this->answerObj->where('user_id', $params['user_id'])->orderBy('created_at', 'asc')->get();

        $questions = $this->questionObj->get();

        $options = $this->optionObj->get();

        $results = [];

        foreach ($answers as $key => $answer) {
            for ($i = 1; $i <= count($questions); $i++) {
                $answerColumn = 'question' . $i . '_answer_id';
                $timeTakenColumn = 'question' . $i . '_time_taken';

                if (! array_key_exists($answerColumn, $results)) {
                    $results[$answerColumn] = [];
                }

                $results[$answerColumn][] = [
                    'id' => $answer->id,
                    'answer_id' => $answer->{$answerColumn},
                    'time_taken' => $answer->{$timeTakenColumn},
                    'created_at' => $answer->created_at,
                ];
            }
        }

        foreach ($questions as $key => $question) {
            $answerColumn = (! empty($question->answers_ref_column) ? $question->answers_ref_column : 'question' . $question->id . '_answer_id');
            $questions[$key]['result'] = (! empty($results) ? $results[$answerColumn] : []);
        }

        $data['data']['questions'] = $questions;
        $data['data']['options'] = $options;

        return $data;
    }

    /**
     * Class private methods
     */
    public function syncClientMetadata(object $client, array $inputs)
    {
        if (! empty($client)) {
            $clientMetadata = $client->clientMetadata;
            if ($inputs['exam_type'] == config('site.exam.exam_type.cci')) {
                $client->clientMetadata()->update([
                    'conducted_cci_count' => $clientMetadata->conducted_cci_count + 1,
                ]);
            } elseif ($inputs['exam_type'] == config('site.exam.exam_type.cci_glycan_age')) {
                $client->clientMetadata()->update([
                    'conducted_glycan_count' => $clientMetadata->conducted_glycan_count + 1,
                ]);
            } elseif ($inputs['exam_type'] == config('site.exam.exam_type.cci_plus')) {
                $client->clientMetadata()->update([
                    'conducted_cci_plus_count' => $clientMetadata->conducted_cci_plus_count + 1,
                ]);
            } elseif ($inputs['exam_type'] == config('site.exam.exam_type.cci_consultation')) {
                $client->clientMetadata()->update([
                    'conducted_cci_consultation_count' => $clientMetadata->conducted_cci_consultation_count + 1,
                ]);
            }
        }
    }

    private function syncParticipantMetadata(object $participant, array $inputs)
    {
        if (empty($participant->clint_id)) {
            if (isset($inputs['is_participant_multiple_exam']) && $inputs['is_participant_multiple_exam']) {
                $participantMetadata = $participant->getParticipantMetadata($inputs['exam_type']);

                if (! empty($participantMetadata['id'])) {
                    $participant->participantMetadata()->where('id', $participantMetadata['id'])->update([
                        'conducted_exam_count' => $participantMetadata['conducted_exam_count'] + 1,
                    ]);
                }
            }
        }
    }
}
