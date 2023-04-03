<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Helpers\ApiResponse;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function  getAllProducts()
    {
        $products = $this->productService->getAllProducts();
        return ApiResponse::createSuccessResponse($products);
    }

    public function getProductById($id)
    {
        $product = $this->productService->getProductById($id);
        return ApiResponse::createSuccessResponse($product);
    }

    public function createProduct(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return ApiResponse::createSuccessResponse($product);
    }
}
