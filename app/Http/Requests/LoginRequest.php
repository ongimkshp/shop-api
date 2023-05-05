<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'email' => 'required|string|email|exists:users,email',
            'password' => [
                'required', 'string',
                Rules\Password::defaults(),
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $this->email)->first();
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('The provided credentials are incorrect.');
                    }
                },
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'email.email' => 'Email is invalid!',
            'email.exists' => 'Email is not exists!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must be at least 8 characters!',
            'password.max' => 'Password must be at most 16 characters!',
        ];
    }
}
