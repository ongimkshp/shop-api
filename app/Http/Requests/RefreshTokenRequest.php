<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *      title="RefreshTokenRequest",
 *      description="RefreshTokenRequest request body data",
 *      type="object",
 *      required={"refresh_token"},
 *      @OA\Property(
 *        property="refresh_token",
 *        type="string",
 *        description="Refresh token",
 *        example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMDYyZjYyZjYtZ
 *        mY2ZC00ZjY0LWE5ZjUtYjYwZjY2ZjY2ZjY2IiwiaWF0IjoxNjIyNjQ0NjYyLCJleHAiOjE2MjI2NDg
 *        yNjIsImNsaWVudF9pZCI6IjEiLCJzY29wZXMi"
 *      )
 *   )
 */


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
