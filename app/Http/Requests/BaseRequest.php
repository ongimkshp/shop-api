<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $listErrors = $validator->errors();
        $response = ApiResponse::createFailedResponse($listErrors, 422, 'VALIDATION_FAILED');
        throw new ValidationException($validator, $response);
    }
}
