<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ProductImageRequest;
use App\Http\Services\ProductImageService;
use App\Http\Resources\ProductImageResource;

class ProductImageController extends Controller
{

    private $productImageService;

    public function __construct(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    public function getProductImages($productId)
    {
        $images = $this->productImageService->getProductImages($productId);
        return ApiResponse::createSuccessResponse(ProductImageResource::collection($images));
    }

    public function createProductImage(ProductImageRequest $request)
    {
        $image = $this->productImageService->createProductImage($request);
        return ApiResponse::createSuccessResponse(new ProductImageResource($image));
    }
}
