<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $authRole = auth('sanctum')->user()->role;

        if (isset($authRole) && $authRole['name'] == config('site.roles.user')) {
            return $this->patientValidation();
        }

        return [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'company_name' => isset($authRole) && $authRole['name'] !== config('site.roles.admin')
                ? 'required|max:120'
                : 'nullable|max:120',
            'username' => 'sometimes|max:120|unique:users,username,' . auth()->id(),
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'address' => 'nullable|max:255',
            'mobile_no' => 'sometimes|max:12',
        ];
    }

    private function patientValidation()
    {
        $rules = [
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'birth_of_country_id' => 'required|numeric',
            'birth_of_city' => 'required',
            'birthdate' => 'required',
            'age_verified_by' => 'required|in:' . implode(',', config('site.age_verified_by')),
            'gender' => 'required|in:' . implode(',', config('site.gender')),
            'marital_status' => 'required|in:' . implode(',', config('site.marital_status')),
            'describe_you_text' => 'nullable',
            'education' => 'required|in:' . implode(',', config('site.education')),
            'living_status' => 'required|in:' . implode(',', config('site.living_status')),
            'feel_age' => 'required|numeric',
            'state_of_health' => 'required|in:' . implode(',', config('site.state_of_health')),
            'current_major_illness_text' => 'nullable',
        ];

        if (empty($this->input('describe_you'))) {
            $rules['describe_you_text'] = 'required';
        } else {
            $rules['describe_you'] = 'required|array';
            $rules['describe_you.*'] = 'exists:dropdown_options,id';
        }

        if (empty($this->input('current_major_illness'))) {
            $rules['current_major_illness_text'] = 'required';
        } else {
            $rules['current_major_illness'] = 'required|array';
            $rules['current_major_illness.*'] = 'exists:dropdown_options,id';
        }

        return $rules;
    }
}
