<?php

namespace App\Http\Requests;


class RefreshTokenRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'refresh_token' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'refresh_token.required' => 'Refresh token is required'
        ];
    }
}
