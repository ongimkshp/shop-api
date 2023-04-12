<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CollectionRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:255|string|unique:collections,title',
            'sort_order' => 'in:alpha-asc,alpha-desc,best-selling,created,created-desc,price-asc,price-desc,manual',
            'published' => 'boolean',
            'product_ids' => 'array',
            'product_ids.*' => 'uuid|exists:products,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be string',
            'title.unique' => 'Title is already taken',
            'title.max' => 'Title must be less than 255 characters',
            'sort_order.in' => 'Sort order is invalid',
            'published.boolean' => 'Published must be boolean',
            'product_ids.array' => 'Product ids must be array',
            'product_ids.*.exists' => 'Product id is not exists',
            'product_ids.*.uuid' => 'Product id is not uuid',
        ];
    }
}
