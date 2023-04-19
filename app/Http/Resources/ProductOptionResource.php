<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="ProductOption",
 *   description="ProductOption model",
 *   @OA\Xml(
 *     name="ProductOption"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="ProductOption id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="product_id",
 *     type="uuid",
 *     description="ProductOption product_id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="ProductOption name",
 *     example="ProductOption name"
 *     ),
 *   @OA\Property(
 *     property="values",
 *     type="array",
 *     description="ProductOption values",
 *     @OA\Items(
 *       type="string",
 *       example="M"
 *       ),
 *     example={"M", "L", "XL"}
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="ProductOption created at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="ProductOption updated at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *  )
 */

class ProductOptionResource extends JsonResource
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
            'name' => $this->name,
            'values' => json_decode($this->values),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}