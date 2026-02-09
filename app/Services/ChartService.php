<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Traits\BaseModel;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;

/**
 * @tags Chart
 */
class ChartService
{
    use ApiResponser, BaseModel;

    public function __construct(private Question $questionObj, private Answer $answerObj)
    {
        //
    }

    public function questionAverageTimes($inputs)
    {
        if (Auth::user()->hasRole(config('site.roles.client'))) {
            $answers = $this->answerObj->whereHas('user', function ($q) {
                $q->where('client_id', Auth::user()->id);
            })->get();
        } else {
            $answers = $this->answerObj->get();
        }

        $questions = $this->questionObj->get();

        $results = [];
        foreach ($questions as $question) {
            $answerColumn = (! empty($question->answers_ref_column) ? $question->answers_ref_column : 'question' . $question->id . '_answer_id');
            $quePrefix = explode('_', $answerColumn)[0];

            $avgTimeTaken = (count($answers) > 0 ? $answers->avg($quePrefix . '_time_taken') : 0);
            $temp[] = $avgTimeTaken;
            $queKey = 'q' . substr($quePrefix, 8);

            $results[$queKey] = [
                'label' => $question->label,
                'value' => (float) sprintf('%0.2f', $avgTimeTaken),
            ];
        }

        $data['data'] = $results;

        return $data;
    }
}
