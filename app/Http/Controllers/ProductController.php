<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Helpers\ApiResponse;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts(Request $request)
    {
        $data = $this->productService->getProducts($request);
        return ApiResponse::createSuccessResponse($data);
    }

    public function getProductById($id)
    {
        $product = $this->productService->getProductById($id);
        return ApiResponse::createSuccessResponse(new ProductResource($product));
    }

    public function createProduct(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return ApiResponse::createSuccessResponse(new ProductResource($product));
    }
}
