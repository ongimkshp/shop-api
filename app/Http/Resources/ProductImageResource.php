<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="ProductImage",
 *   description="ProductImage model",
 *   @OA\Xml(
 *     name="ProductImage"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="ProductImage id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="product_id",
 *     type="uuid",
 *     description="ProductImage product_id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="src",
 *     type="string",
 *     description="ProductImage src",
 *     example="/storage/product_images/1.jpg"
 *     ),
 *   @OA\Property(
 *     property="position",
 *     type="integer",
 *     description="ProductImage position",
 *     example="1"
 *     ),
 *   @OA\Property(
 *     property="alt",
 *     type="string",
 *     description="ProductImage alt",
 *     example="ProductImage alt"
 *     ),
 *   @OA\Property(
 *     property="width",
 *     type="integer",
 *     description="ProductImage width",
 *     example="1"
 *     ),
 *   @OA\Property(
 *     property="height",
 *     type="integer",
 *     description="ProductImage height",
 *     example="1"
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="ProductImage created at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="ProductImage updated at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *  )
 */


class ProductImageResource extends JsonResource
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
            'product_id' => $this->product_id,
            'src' => $this->src,
            'position' => $this->position,
            'alt' => $this->alt,
            'width' => $this->width,
            'height' => $this->height,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
