<?php

namespace App\Http\Requests\TestResult;

use Illuminate\Foundation\Http\FormRequest;

class showFactors extends FormRequest
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
            'flag' => 'required',
            'lang' => ''
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['flag' => $this->flag]);
        $this->merge(['lang' => $this->lang]);
    }
}
