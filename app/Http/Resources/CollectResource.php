<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="Collect",
 *   description="Collect model",
 *   @OA\Xml(
 *     name="Collect"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="Collect id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="collection_id",
 *     type="uuid",
 *     description="Collect collection_id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="product_id",
 *     type="uuid",
 *     description="Collect product_id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="Collect created at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="Collect updated at",
 *     example="2020-11-12 12:00:00"
 *     ),
 * )
 */

class CollectResource extends JsonResource
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
            'collection_id' => $this->collection_id,
            'product_id' => $this->product_id,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
