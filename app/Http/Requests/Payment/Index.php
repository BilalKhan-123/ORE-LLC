<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'filter[user_id]' => 'nullable',
            'include' => 'nullable',
            'page' => 'nullable',
            'limit' => 'nullable',
            'sort' => 'nullable',
        ];
    }
}
