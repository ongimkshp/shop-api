<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *   schema="ProductImageRequest",
 *   type="object",
 *   @OA\Property(
 *     property="product_id",
 *     type="uuid",
 *     description="Product ID",
 *     example="1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p"
 *     ),
 *   @OA\Property(
 *     property="variant_ids",
 *     type="array",
 *     description="Variant IDs",
 *     @OA\Items(
 *       type="uuid",
 *       example="1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p"
 *       ),
 *     example={"1a2b3c4d-5e6f-7g8h-9i0j-1k2l3m4n5o6p", "2b3c4d5e-6f7g-8h9i-0j1k-2l3m4n5o6p7q"}
 *     ),
 *   @OA\Property(
 *     property="image_file",
 *     type="file",
 *     description="Image file",
 *     example="image.jpg"
 *     ),
 *   @OA\Property(
 *     property="position",
 *     type="integer",
 *     description="Position",
 *     example="1"
 *     ),
 *   @OA\Property(
 *     property="width",
 *     type="string",
 *     description="Width",
 *     example="100"
 *     ),
 *   @OA\Property(
 *     property="height",
 *     type="string",
 *     description="Height",
 *     example="100"
 *     ),
 *   )
 */

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
