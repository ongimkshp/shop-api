<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductOptionRepositoryInterface;

class ProductOptionService
{

    private $productOptionRepo;

    public function __construct(ProductOptionRepositoryInterface $productOptionRepository)
    {
        $this->productOptionRepo = $productOptionRepository;
    }

    public function createOptions($attributes, $productId)
    {
        $option = [];
        foreach ($attributes as $attribute) {
            $option['product_id'] = $productId;
            $option['name'] = $attribute['name'];
            $option['values'] = json_encode($attribute['values']);
            $this->productOptionRepo->createOption($option);
        }
    }
}
