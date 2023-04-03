<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct($request)
    {
        $attributes = $request->only(["title", "product_type", "vendor", "status"]);
        return $this->productRepository->createProduct($attributes);
    }
}
