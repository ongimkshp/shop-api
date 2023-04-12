<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CollectRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'collection_id' => 'required|uuid|exists:collections,id',
            'product_id' => [
                'required',
                'uuid',
                'exists:products,id',
                Rule::unique('collects')->where(function ($query) {
                    $query->where('collection_id', $this->collection_id);
                }),
            ]
        ];
    }

    public function messages()
    {
        return [
            'collection_id.required' => 'Collection id is required',
            'collection_id.uuid' => 'Collection id is not uuid',
            'collection_id.exists' => 'Collection id is not exists',
            'product_id.required' => 'Product id is required',
            'product_id.uuid' => 'Product id is not uuid',
            'product_id.exists' => 'Product id is not exists',
            'product_id.unique' => 'Product is already exists in this collection',

        ];
    }
}
