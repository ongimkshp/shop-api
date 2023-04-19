<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="Product",
 *   description="Product model",
 *   @OA\Xml(
 *     name="Product"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="Product id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Product title",
 *     example="Product title"
 *     ),
 *   @OA\Property(
 *     property="status",
 *     type="string",
 *     description="Product status",
 *     example="Product status"
 *     ),
 *   @OA\Property(
 *     property="options",
 *     type="array",
 *     description="Product options",
 *     @OA\Items(ref="#/components/schemas/ProductOptionResource")
 *    ),
 *   @OA\Property(
 *     property="variants",
 *     type="array",
 *     description="Product variants",
 *     @OA\Items(ref="#/components/schemas/VariantResource")
 *     ),
 *   @OA\Property(
 *     property="images",
 *     type="array",
 *     description="Product images",
 *     @OA\Items(ref="#/components/schemas/ProductImageResource")
 *     ),
 *   @OA\Property(
 *     property="image",
 *     type="array",
 *     description="Product image",
 *     @OA\Items(ref="#/components/schemas/ProductImageResource")
 *     ),
 *   @OA\Property(
 *     property="product_type",
 *     type="string",
 *     description="Product product_type",
 *     example="Product product_type"
 *     ),
 *   @OA\Property(
 *     property="vendor",
 *     type="string",
 *     description="Product vendor",
 *     example="Product vendor"
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="Product created_at",
 *     example="Product created_at"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="Product updated_at",
 *     example="Product updated_at"
 *     ),
 *  )
 */


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'options' => ProductOptionResource::collection($this->options),
            'variants' => VariantResource::collection($this->variants),
            'images' => ProductImageResource::collection($this->images),
            'image' => $this->images ? new ProductImageResource($this->images->first()) : null,
            'product_type' => $this->product_type,
            'vendor' => $this->vendor,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
