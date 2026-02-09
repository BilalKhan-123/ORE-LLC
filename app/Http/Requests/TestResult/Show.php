<?php

namespace App\Http\Requests\TestResult;

use Illuminate\Foundation\Http\FormRequest;

class Show extends FormRequest
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
            'answer_id' => 'required|exists:answers,id',
            'lang' => ''
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['answer_id' => $this->test_id]);
        $this->merge(['lang' => $this->lang]);
    }
}
