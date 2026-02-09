<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUp extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:120',
            'username' => 'required|max:120|unique:users,username',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed|regex:' . config('site.password.regex'),
            'address' => 'nullable|max:255',
            'mobile_no' => 'nullable|numeric|digits:10',
        ];
    }
}
