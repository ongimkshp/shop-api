<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|confirmed|max:255|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be string',
            'name.max' => 'Name must be less than 255 characters',
            'email.required' => 'Email is required',
            'email.string' => 'Email must be string',
            'email.email' => 'Email must be valid email',
            'email.unique' => 'Email is already exists',
            'email.max' => 'Email must be less than 255 characters',
            'password.required' => 'Password is required',
            'password.string' => 'Password must be string',
            'password.confirmed' => 'Password confirmation is not match',
            'password.max' => 'Password must be less than 255 characters',
            'password.min' => 'Password must be at least 8 characters',
        ];
    }
}
