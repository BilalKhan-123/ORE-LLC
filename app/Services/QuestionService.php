<?php

namespace App\Services;

use App\Models\Question;

class QuestionService
{
    public function __construct(private Question $questionObj)
    {
        //
    }

    public function collection($inputs = null)
    {
        $questions = $this->questionObj->getQB();

        $inputs['limit'] = isset($inputs['limit']) ? $inputs['limit'] : config('site.paginationLimit');

        return (isset($inputs['limit']) && $inputs['limit'] == '-1') ? $questions->get() : $questions->paginate($inputs['limit']);
    }
}
