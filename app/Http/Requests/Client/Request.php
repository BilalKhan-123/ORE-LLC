<?php

namespace App\Http\Requests\Client;

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
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'company_name' => 'required|max:120',
            'mobile_no' => 'sometimes|max:12',
            'birth_of_country_id' => 'nullable|exists:countries,id',
            'birth_of_state_id' => 'nullable|exists:states,id',
            'birth_of_city' => 'nullable|max:255',
            'zipcode' => 'nullable|max:10',
            'address' => 'nullable|max:500',
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = 'required|email|max:255|unique:users';
        } else {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->client;
        }

        $rules['purchase_exams'] = 'array';
        $rules['purchase_exams.*.exam_type'] = 'required_with:purchase_exams|in:cci,cci_glycan_age,cci_plus,cci_consultation';
        $rules['purchase_exams.*.type'] = 'required_with:purchase_exams|in:free';
        $rules['purchase_exams.*.quantity'] = 'required_with:purchase_exams|numeric|min:1';

        return $rules;
    }
}
