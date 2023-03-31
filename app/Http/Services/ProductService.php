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

    public function createProduct($attributes)
    {
        return $this->productRepository->createProduct($attributes);
    }
}
