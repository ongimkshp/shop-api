<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User resource",
 *     @OA\Xml(
 *         name="UserResource"
 *     ),
 *     @OA\Property(
 *       property="id",
 *       type="uuid",
 *       description="User id",
 *       example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
 *     ),
 *     @OA\Property(
 *       property="name",
 *       type="string",
 *       description="User name",
 *       example="User name"
 *     ),
 *     @OA\Property(
 *       property="email",
 *       type="string",
 *       description="User email",
 *       example="mail@gmail.com"
 *     ),
 *     @OA\Property(
 *       property="created_at",
 *       type="string",
 *       description="User created_at",
 *       example="2021-01-01 00:00:00"
 *     ),
 *     @OA\Property(
 *       property="updated_at",
 *       type="string",
 *       description="User updated_at",
 *       example="2021-01-01 00:00:00"
 *     ),
 * )
 */

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
