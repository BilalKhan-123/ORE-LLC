<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'timezone' => 'required',
            'start_at' => 'required',
            'completed_at' => 'required',
            'time_taken' => 'required',
            'exam_type' => 'required|in:cci,cci_glycan_age,cci_plus,cci_consultation',
            'questions.*.question_id' => 'required|exists:questions,id',
            'questions.*.selected_answer_id' => 'required|exists:options,id',
            'questions.*.time_taken' => 'required|integer',
            'questions.*.answered_at' => 'required',
        ];
    }
}
