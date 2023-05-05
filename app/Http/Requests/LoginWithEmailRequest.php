<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="LoginWithEmailRequest",
 *      description="LoginWithEmailRequest request body data",
 *      type="object",
 *      required={"email"},
 *      @OA\Property(
 *        property="email",
 *        type="string",
 *        description="Email",
 *        example="manh@gmail.com"
 *      )
 *    )
 */


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
