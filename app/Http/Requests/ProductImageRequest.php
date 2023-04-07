<?php

namespace App\Http\Requests;

class ProductImageRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'variant_ids' => 'nullable|array',
            'variant_ids.*' => 'nullable|exists:variants,id',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'position' => 'nullable|integer',
            'width' => 'nullable|string',
            'height' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product ID is required',
            'product_id.exists' => 'Product ID does not exist',
            'variant_ids.array' => 'Variant IDs must be an array',
            'variant_ids.*.exists' => 'Variant ID does not exist',
            'image_file.required' => 'Image file is required',
            'image_file.image' => 'Image file must be an image',
            'image_file.mimes' => 'Image file must be a file of type: jpeg, png, jpg, gif, svg',
            'image_file.max' => 'Image file may not be greater than 5000 kilobytes',
            'position.integer' => 'Position must be an integer',
            'width.string' => 'Width must be a string',
            'height.string' => 'Height must be a string',
        ];
    }
}
