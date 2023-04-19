<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="Variant",
 *   description="Variant model",
 *   @OA\Xml(
 *     name="Variant"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="Variant id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="product_id",
 *     type="uuid",
 *     description="Variant product_id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Variant title",
 *     example="Variant title"
 *     ),
 *   @OA\Property(
 *     property="price",
 *     type="string",
 *     description="Variant price",
 *     example="Variant price"
 *     ),
 *   @OA\Property(
 *     property="gram",
 *     type="string",
 *     description="Variant gram",
 *     example="Variant gram"
 *     ),
 *   @OA\Property(
 *     property="option1",
 *     type="string",
 *     description="Variant option1",
 *     example="Variant option1"
 *     ),
 *   @OA\Property(
 *     property="option2",
 *     type="string",
 *     description="Variant option2",
 *     example="Variant option2"
 *     ),
 *   @OA\Property(
 *     property="option3",
 *     type="string",
 *     description="Variant option3",
 *     example="Variant option3"
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="Variant created at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="Variant updated at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *  )
 */

class VariantResource extends JsonResource
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
            'title' => $this->option1 . ' ' . $this->option2 . ' ' . $this->option3,
            'price' => $this->price,
            'gram' => $this->gram,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
