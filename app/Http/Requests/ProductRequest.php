<?php

namespace App\Http\Requests;

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|unique:products,title',
            'status' => 'in:active,draft,archived',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "can't be blank",
            'title.unique' => 'has already been taken',
            'status.in' => 'is incorrect',
        ];
    }
}
