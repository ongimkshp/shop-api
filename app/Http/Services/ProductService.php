<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        $product = DB::transaction(function () use ($attributes, $optionsAttr) {
            $product = $this->productRepository->createProduct($attributes);
            $this->productOptionService->createOptions($optionsAttr, $product->id);
            return $product;
        });
        return $product;
    }
}
