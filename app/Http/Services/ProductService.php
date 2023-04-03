<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Resources\ProductResource;

class ProductService
{

    private $productRepository;
    private $productOptionService;

    public function __construct(ProductRepositoryInterface $productRepository, ProductOptionService $productOptionService)
    {
        $this->productRepository = $productRepository;
        $this->productOptionService = $productOptionService;
    }

    public function createProduct($request)
    {
        $attributes = $request->only(['title', 'product_type', 'status', 'vendor']);
        $optionsAttr = $request->options;
        $product = $this->productRepository->createProduct($attributes);
        $this->productOptionService->createOptions($optionsAttr, $product->id);
        return $product;
    }
}
