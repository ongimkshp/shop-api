<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   title="Collection",
 *   description="Collection model",
 *   @OA\Xml(
 *     name="Collection"
 *     ),
 *   @OA\Property(
 *     property="id",
 *     type="uuid",
 *     description="Collection id",
 *     example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *   @OA\Property(
 *     property="title",
 *     type="string",
 *     description="Collection title",
 *     example="Collection title"
 *     ),
 *   @OA\Property(
 *     property="sort_order",
 *     type="string",
 *     description="Collection sort_order",
 *     example="Collection sort_order"
 *     ),
 *   @OA\Property(
 *     property="created_at",
 *     type="string",
 *     description="Collection created at",
 *     example="2020-11-12 12:00:00"
 *     ),
 *   @OA\Property(
 *     property="updated_at",
 *     type="string",
 *     description="Collection updated at",
 *     example="2020-11-12 12:00:00"
 *     ),
 * )
 */

class CollectionResource extends JsonResource
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
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
