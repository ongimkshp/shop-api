<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class VariantRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'option1' => 'required|max:255',
            'option2' => 'max:255',
            'option3' => 'max:255',
            'product_id' => [
                'required',
                'exists:products,id',
                Rule::unique('variants')->where(function ($query) {
                    $query->where('option1', $this->option1)
                        ->where('option2', $this->option2)
                        ->where('option3', $this->option3);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product id is required',
            'product_id.exists' => 'Product id is not exists',
            'option1.required' => 'Option is required',
            'option1.max' => 'Option must be less than 255 characters',
            'option2.max' => 'Option must be less than 255 characters',
            'option3.max' => 'Option must be less than 255 characters',
            'product_id.unique' => 'Variant is already exists',
        ];
    }
}
