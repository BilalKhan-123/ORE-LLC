<?php

namespace App\Http\Requests\FactorExplanationConfig;

use Request as RouteRequest;
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
        $rules = [
            'factor' => 'required|max:200',
            //'language' => 'required|max:120',
            'name' => 'required|max:250',
            'high_score' => 'required',
            'low_score' => 'required',
            'high_score_suggestion' => 'required',
            'low_score_suggestion' => 'required',
        ];

        return $rules;
    }
}
