<?php

namespace App\Http\Requests;

class ProductRequest extends BaseRequest
{
    public function rules()
    {
        $rules =  [
            'title' => 'required|unique:products,title|max:255',
            'status' => 'in:active,draft,archived',
            'options' => 'array|max:3',
            'options.*.name' => 'required|max:255',
            'options.*.values' => 'required|array',
            'options.*.values.*' => 'required|max:255',
            'variants' => 'array|max:100',
            'variants.*.option1' => 'required|max:255',
            'variants.*.option2' => 'max:255',
            'variants.*.option3' => 'max:255',
            'images' => 'array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];
        if (in_array($this->method(), ['PUT'])) {
            $rules = [
                'title' => 'unique:products,title|max:255',
                'status' => 'in:active,draft,archived',
                'variants' => 'array|max:100',
                'variants.*.id' => 'uuid|required|exists:variants,id',
                'images' => 'array',
                'images.*.id' => 'uuid|exists:product_images,id',
                'images.*.src' => 'string|max:255',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => "can't be blank",
            'title.unique' => 'has already been taken',
            'title.max' => 'is too long (maximum is 255 characters)',
            'status.in' => 'is incorrect',
            'options.array' => 'is incorrect type (array expected)',
            'options.max' => 'is too long (maximum is 3 items)',
            'variants.array' => 'is incorrect type (array expected)',
            'variants.max' => 'is too long (maximum is 100 items)',
            'images.array' => 'is incorrect type (array expected)',
            'images.*.image_file.required' => "can't be blank",
            'images.*.image_file.image' => 'is not a valid image',
            'images.*.image_file.mimes' => 'is not a valid image',
        ];
    }
}
