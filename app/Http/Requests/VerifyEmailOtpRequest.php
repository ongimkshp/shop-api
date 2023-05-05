<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="VerifyEmailOtpRequest",
 *      description="VerifyEmailOtpRequest request body data",
 *      type="object",
 *      required={"userId", "signature"},
 *      @OA\Property(
 *        property="userId",
 *        type="string",
 *        description="User id",
 *        example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *      ),
 *      @OA\Property(
 *        property="signature",
 *        type="string",
 *        description="Signature",
 *        example="signature"
 *      ),
 * )
 */

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
