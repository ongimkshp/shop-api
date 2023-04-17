<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
