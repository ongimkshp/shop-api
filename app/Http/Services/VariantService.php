<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\VariantRepositoryInterface;
use Illuminate\Support\Str;

class VariantService
{
    private $variantRepository;

    public function __construct(VariantRepositoryInterface $variantRepository)
    {
        $this->variantRepository = $variantRepository;
    }

    public static function createVariantTitle($attributes)
    {
        $title = $attributes['option1'];
        if (isset($attributes['option2'])) {
            $title .= ' / ' . $attributes['option2'];
        }
        if (isset($attributes['option3'])) {
            $title .= ' / ' . $attributes['option3'];
        }
        return $title;
    }

    public function createVariant($request)
    {
        $attributes = $request->only([
            'product_id',
            'price',
            'grams',
            'quantity',
            'option1',
            'option2',
            'option3',
        ]);
        $attributes['title'] = self::createVariantTitle($attributes);
        return $this->variantRepository->createVariant($attributes);
    }

    public function createMultiVariant($attributes, $productId)
    {
        $variants = array_map(function ($attribute) use ($productId) {
            return [
                'id' => Str::uuid(),
                'product_id' => $productId,
                'title' => self::createVariantTitle($attribute),
                'price' => isset($attribute['price']) ? $attribute['price'] : null,
                'gram' => isset($attribute['gram']) ? $attribute['gram'] : null,
                'option1' => $attribute['option1'],
                'option2' => isset($attribute['option2']) ? $attribute['option2'] : null,
                'option3' => isset($attribute['option3']) ? $attribute['option3'] : null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $attributes);
        return $this->variantRepository->createMultiVariant($variants);
    }
}
