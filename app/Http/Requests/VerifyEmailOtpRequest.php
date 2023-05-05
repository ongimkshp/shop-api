<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailOtpRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'userId' => 'required',
            'signature' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'userId.required' => 'User id is required',
            'signature.required' => 'Signature is required',
        ];
    }
}
