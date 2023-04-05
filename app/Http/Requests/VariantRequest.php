<?php

namespace App\Http\Requests;

use App\Http\Services\VariantService;
use App\Models\Product;

class VariantRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'option1' => 'required|max:255',
            'option2' => 'max:255',
            'option3' => 'max:255',
            'product_id' => ['required', 'exists:products,id', function ($attribute, $value, $fail) {
                $titleStr = VariantService::createVariantTitle($this->all());
                if (Product::find($value)->variants()->where('title', $titleStr)->exists()) {
                    $fail('Product already has this set of 3 options');
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product id is required',
            'product_id.exists' => 'Product id is not exists',
            'option1.required' => 'Option is required',
            'option1.max' => 'Option must be less than 255 characters',
        ];
    }
}
