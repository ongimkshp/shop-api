<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductOptionRepositoryInterface;
use Illuminate\Support\Str;

class ProductOptionService
{

    private $productOptionRepo;

    public function __construct(ProductOptionRepositoryInterface $productOptionRepository)
    {
        $this->productOptionRepo = $productOptionRepository;
    }

    public function createOptions($attributes, $productId)
    {
        $options = array_map(function ($attribute) use ($productId) {
            return [
                'id' => Str::uuid(),
                'product_id' => $productId,
                'name' => $attribute['name'],
                'values' => json_encode($attribute['values'])
            ];
        }, $attributes);
        $this->productOptionRepo->createOptions($options);
    }
}
