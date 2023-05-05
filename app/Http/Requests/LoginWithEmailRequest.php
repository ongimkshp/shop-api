<?php

namespace App\Http\Requests;

class LoginWithEmailRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'email' => 'required|string|email|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.exists' => 'Email does not exist',
        ];
    }
}
