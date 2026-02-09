<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class Index extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable',
            'limit' => 'nullable',
            'sort' => 'nullable',
            'include' => 'nullable',
            'filter[user_id]' => 'nullable',
            'filter[start_date]' => 'nullable',
            'filter[end_date]' => 'nullable',
        ];
    }
}
