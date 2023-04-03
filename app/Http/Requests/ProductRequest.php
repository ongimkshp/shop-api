<?php

namespace App\Http\Requests;

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|unique:products,title|max:255',
            'status' => 'in:active,draft,archived',
            'options' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => "can't be blank",
            'title.unique' => 'has already been taken',
            'title.max' => 'is too long (maximum is 255 characters)',
            'status.in' => 'is incorrect',
            'options.array' => 'is incorrect type',
        ];
    }
}
