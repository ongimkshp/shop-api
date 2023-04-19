<?php

namespace App\Http\Requests;

// write doc $OA CollectionRequest here
/**
 * @OA\Schema(
 *   schema="CollectionRequest",
 *   type="object",
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Title of collection",
 *     example="Collection 1"
 *     ),
 *   @OA\Property(
 *     property="sort_order",
 *     type="string",
 *     description="Sort order of collection",
 *     example="alpha-asc"
 *   ),
 *   @OA\Property(
 *     property="published",
 *     type="boolean",
 *     description="Published of collection",
 *     example="true"
 *   ),
 *   @OA\Property(
 *     property="product_ids",
 *     type="array",
 *     description="Product ids of collection",
 *     example="['asdasd-123123-asdasd-123123', 'asdasd-123123-asdasd-123123']",
 *     @OA\Items(
 *       type="string",
 *             example="asdasd-123123-asdasd-123123"
 *       ),
 *     ),
 *  )
 */

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
