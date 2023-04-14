<?php

namespace App\Http\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private const LIMIT_DEFAULT = 100;
    private const PAGE_DEFAULT = 0;

    private $productRepository;
    private $productOptionService;
    private $variantService;
    private $productImageService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductOptionService $productOptionService,
        VariantService $variantService,
        ProductImageService $productImageService
    ) {
        $this->productRepository = $productRepository;
        $this->productOptionService = $productOptionService;
        $this->variantService = $variantService;
        $this->productImageService = $productImageService;
    }

    public function getProducts($request)
    {
        $pagram = $request->all();
        $pagram['limit'] = $pagram['limit'] ?? self::LIMIT_DEFAULT;
        $pagram['page'] = $pagram['page'] ?? self::PAGE_DEFAULT;
        $product = $this->productRepository->getProducts($pagram['limit'], $pagram['page']);
        return $product;
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct($request)
    {
        $attributes = $request->only(['title', 'product_type', 'status', 'vendor']);
        $optionsAttr = $request->options;
        $variantsAttr = $request->variants;
        $imageAttr = $request->images;
        $product = DB::transaction(function () use ($attributes, $optionsAttr) {
            $product = $this->productRepository->createProduct($attributes);
            if ($optionsAttr) {
                $this->productOptionService->createOptions($optionsAttr, $product->id);
            }
            return $product;
        });
        if ($variantsAttr) {
            $this->variantService->createMultiVariant($variantsAttr, $product->id);
        }
        if ($imageAttr) {
            $this->productImageService->createMultiProductImages($imageAttr, $product->id);
        }
        return $product;
    }

    public function updateProduct($id, $request)
    {
        $product = $this->productRepository->findById($id);
        $attributes = $request->only(['title', 'product_type', 'status', 'vendor']);
        $product->fill($attributes);
        $variantsAttr = $request->variants;
        $this->variantService->updateMultiVariant($variantsAttr);
        $imageAttr = $request->images;
        if (count($imageAttr) > 0) {
            $this->productImageService->updateMultiImagesOnProduct($imageAttr, $product->id);
        } else {
            $this->productImageService->deleteAllImagesOnProduct($product->id);
        }


        return $product;
    }
}
