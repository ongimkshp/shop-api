<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\ProductImageRequest;
use App\Http\Services\ProductImageService;

class ProductImageController extends Controller
{

    private $productImageService;

    public function __construct(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    public function createProductImage(ProductImageRequest $request)
    {
        $image = $this->productImageService->createProductImage($request);
        return ApiResponse::createSuccessResponse($image);
    }
}
