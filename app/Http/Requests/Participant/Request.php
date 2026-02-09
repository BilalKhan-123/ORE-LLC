<?php

namespace App\Http\Requests\Participant;

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
            'first_name' => 'required|max:120',
            'last_name' => 'required|max:120',
            'mobile_no' => 'sometimes|max:12',
            'birth_of_country_id' => 'nullable|exists:countris,id',
            'birth_of_state_id' => 'nullable|exists:states,id',
            'birth_of_city' => 'nullable|max:255',
            'zipcode' => 'nullable',
            'address' => 'nullable|max:500',
            'day' => [
                'nullable',
                'regex:/^(0[1-9]|[12][0-9]|3[01]|[1-9])$/'
            ],
            'month' => [
                'nullable',
                'regex:/^(0?[1-9]|1[0-2]|jan(uary)?|feb(ruary)?|mar(ch)?|apr(il)?|may|jun(e)?|jul(y)?|aug(ust)?|sep(tember)?|oct(ober)?|nov(ember)?|dec(ember)?)$/i'
            ],
        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = 'required|email|max:255|unique:users';

            if (RouteRequest::is('*/admin/participants')) {
                $rules['client_id'] = 'sometimes|exists:users,id';
            } elseif (! auth('sanctum')->check()) {
                $rules['client_code'] = 'sometimes|exists:users,client_code';
                $rules['password'] = 'required|min:8|confirmed|regex:' . config('site.password.regex');
            }
        } else {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $this->participant;
        }

        return $rules;
    }
}
