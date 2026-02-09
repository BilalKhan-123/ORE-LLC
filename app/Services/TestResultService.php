<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Answer;
use App\Models\Factor;
use App\Models\Option;
use App\Helpers\Helper;
use App\Traits\BaseModel;
use App\Models\AnswerResult;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use App\Models\FactorExplanationConfig;

class TestResultService
{
    use ApiResponser, BaseModel;

    public function __construct(private Factor $factorObj, private FactorExplanationConfig $factorExplanationConfigObj, private Answer $answerObj, private Option $optionObj, private AnswerResult $answerResultObj)
    {
        //
    }

    public function resource($params, $inputs = [])
    {
        $resultArr = config('site.test_results');
        if (isset($params['flag'])) {
            $data = []; // Initialize as an array
            if ($params['flag'] == 'factors') {
                // $user_id = Auth::user()->id;
                $user_id = 3;
            } else {
                $user_id = $params['flag'];
            }
            $answers = $this->answerObj->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get();
            foreach ($answers as $answer) {
                $answerResults = $answer->answerResult()->with('factor')->where('answer_id', $answer->id)->get();

                foreach ($answerResults as $result) {
                    $factorColumn = $result->factor->getResultColumn();
                    $resultArr[$factorColumn]['result'] = abs($result->result);
                }
                $this->calculatePercentile($resultArr, $answer);

                $resultArr['result_date'] = $answer->created_at;

                $resultArr['user'] = User::select('id', 'first_name', 'last_name', 'birthdate')->findOrFail($answer->user_id);
                $resultArr['user']['result'] = [
                    'start_at' => $answer->start_at,
                    'completed_at' => $answer->completed_at,
                    'created_at' => $answer->created_at,
                    'score' => $answer->score,
                    'time_taken' => $answer->time_taken,
                ];

                $data['data'][] = $resultArr;
            }
        } else {
            $answer = $this->answerObj->find($params['answer_id']);
            if (isset($params['user']) && $params['user']) {
                if (! $answer->checkPermission()) {
                    $data['errors']['message'] = __('message.invalidAction');

                    return $data;
                }
            }

            $answerResults = $answer->answerResult()->with('factor')->get();
            // $answerResults = $this->answerResultObj->with('factor')->get();

            foreach ($answerResults as $result) {
                $factorColumn = $result->factor->getResultColumn();
                $resultArr[$factorColumn]['result'] = abs($result->result);
            }
            //return $resultArr;
            $this->calculateAvarage($resultArr);
            $this->calculatePercentile($resultArr, $answer);

            $resultArr['result_date'] = $answer->created_at;

            $data['data'] = $resultArr;
            $data['data']['user'] = User::select('id', 'first_name', 'last_name', 'birthdate')->findOrFail($answer->user_id);
            $data['data']['user']['result'] = [
                'start_at' => $answer->start_at,
                'completed_at' => $answer->completed_at,
                'created_at' => $answer->created_at,
                'score' => $answer->score,
                'time_taken' => $answer->time_taken,
            ];
        }
        if (is_null($params['lang'])) {
            $factorsExplanations = $this->factorExplanationConfigObj->where('language', 'en')->get();
        } else {
            $factorsExplanations = $this->factorExplanationConfigObj->where('language', $params['lang'])->get();
        }
        $data['data']['factors_explanations'] = $factorsExplanations;

        return $data;
    }

    public function compare($inputs)
    {
        $answers = $this->answerObj->select('id', 'user_id')->where('user_id', $inputs['user_id'])->orderBy('created_at', 'desc');
        $resultArr = config('site.test_results');
        foreach ($answers->get() as $answer) {
            $answerResults = $answer->answerResult()->with('factor')->get();
            foreach ($answerResults as $result) {
                $factorColumn = $result->factor->getResultColumn();
                $resTotal = abs($result->result);
                //$resTotal = abs($result->result) + abs($resultArr[$factorColumn]['min']);
                $resultArr[$factorColumn]['result'][$resTotal][] = [
                    'label' => Carbon::parse($answer->completed_at)->format(config('site.format.date')),
                    'value' => $resTotal,
                ];
            }
        }
        $this->calculateAvarage($resultArr);

        $data['data'] = $resultArr;
        $data['data']['user'] = User::select('id', 'first_name', 'last_name', 'birthdate')->findOrFail($inputs['user_id']);

        return $data;
    }

    /**
     * Private methods
     */
    private function calculateAvarage(array &$resultArr)
    {
        $participant = User::select('id')->with(['firstAnswer' => function ($query) {
            return $query->select('id', 'user_id')->with('answerResult')->orderBy('id');
        }])->whereHas('roles', function ($query) {
            return $query->where('name', config('site.roles.user'));
        })->whereHas('firstAnswer');

        $participantCount = $participant->count();

        foreach ($participant->get() as $user) {
            $tempResult = $user->firstAnswer->answerResult;
            foreach ($tempResult as $res) {
                if (isset($resultArr[$res->factor->getResultColumn()]['average'])) {
                    $resultArr[$res->factor->getResultColumn()]['average'] = $resultArr[$res->factor->getResultColumn()]['average'] + $res->result;
                    // Ensure `score` is treated as a string
                    $resultArr[$res->factor->getResultColumn()]['score'] = (string) $resultArr[$res->factor->getResultColumn()]['score'] . ',' . $res->result;
                } else {
                    $resultArr[$res->factor->getResultColumn()]['average'] = $res->result;
                    $resultArr[$res->factor->getResultColumn()]['score'] = $res->result;
                }
            }
        }

        $resultArr = array_map(function ($item) use ($participantCount) {
            $item['average'] = round($item['average'] / $participantCount, 1);
            $item['average'] = abs($item['average']) + abs($item['min']);
            // $item['median'] =  (abs($item['max']) + abs($item['min']))/2;
            $item['median'] = $this->getMedian($item['min'], ($item['max'] + $item['min']));
            $item['max'] = ($item['max'] + $item['min']);
            //$this->getMedianFromCommaSeparatedString( $item['score']) + abs($item['min']);

            return $item;
        }, $resultArr);
    }

    private function getMedian($min, $max)
    {
        $numbers = range($min, $max);
        //  echo count($numbers);
        // echo "The array is: " . $numbers;
        $numbers = array_values($numbers);
        sort($numbers);
        $count = count($numbers);

        if ($count % 2 == 1) {
            $median = $numbers[floor($count / 2)];
        }
        // If the count is even, return the average of the middle two elements
        else {
            $lowMid = $numbers[$count / 2 - 1];
            $highMid = $numbers[$count / 2];
            $median = ($lowMid + $highMid) / 2;
        }

        return $median;
    }

    private function getMedianFromCommaSeparatedString($str)
    {
        // Step 1: Convert the comma-separated string to an array
        $numbers = array_map('intval', explode(',', $str));

        // Step 2: Sort the array
        sort($numbers);

        // Step 3: Calculate the median
        $count = count($numbers);
        $middleIndex = (int) ($count / 2);

        if ($count % 2 == 0) {
            // Even number of elements
            $median = ($numbers[$middleIndex - 1] + $numbers[$middleIndex]) / 2;
        } else {
            // Odd number of elements
            $median = $numbers[$middleIndex];
        }

        return $median;
    }

    private function calculatePercentile(array &$resultArr, object $answer)
    {
        $participant = User::select('id')->with(['firstAnswer' => function ($query) use ($answer) {
            return $query->select('id', 'user_id')->with('answerResult')->where('age_group_id', $answer->age_group_id)->orderBy('id');
        }])->whereHas('roles', function ($query) {
            return $query->where('name', config('site.roles.user'));
        })->whereHas('firstAnswer', function ($query) use ($answer) {
            return $query->where('age_group_id', $answer->age_group_id);
        });

        $dataArr = [];
        foreach ($participant->get() as $user) {
            $tempResult = $user->firstAnswer->answerResult;
            foreach ($tempResult as $res) {
                $dataArr[$res->factor->getResultColumn()][] = $res->result;
            }
        }

        foreach ($dataArr as $itemKy => $itemVal) {
            if (isset($resultArr[$itemKy]['result'])) {
                array_push($dataArr[$itemKy], $resultArr[$itemKy]['result']);
                $getAgeGroupPercentile = Helper::getAgeGroupPercentile($dataArr[$itemKy], $resultArr[$itemKy]['result']);
                $resultArr[$itemKy]['percentile'] = $getAgeGroupPercentile;
            } else {
                $resultArr[$itemKy]['percentile'] = 0;
            }
        }
    }
}
