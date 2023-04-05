<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{

    private $productRepository;
    private $productOptionService;
    private $variantService;
    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductOptionService $productOptionService,
        VariantService $variantService
    ) {
        $this->productRepository = $productRepository;
        $this->productOptionService = $productOptionService;
        $this->variantService = $variantService;
    }

    public function createProduct($request)
    {
        $attributes = $request->only(['title', 'product_type', 'status', 'vendor']);
        $optionsAttr = $request->options;
        $variantsAttr = $request->variants;
        $product = DB::transaction(function () use ($attributes, $optionsAttr, $variantsAttr) {
            $product = $this->productRepository->createProduct($attributes);
            $this->productOptionService->createOptions($optionsAttr, $product->id);
            $this->variantService->createMultiVariant($variantsAttr, $product->id);
            return $product;
        });
        return $product;
    }
}
