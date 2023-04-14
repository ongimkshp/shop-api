<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\VariantRequest;
use App\Http\Services\VariantService;
use App\Http\Resources\VariantResource;

class VariantController extends Controller
{

    private $variantService;

    public function __construct(VariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    public function getVariantsByProductId($productId)
    {
        $variants = $this->variantService->getVariantsByProductId($productId);
        return ApiResponse::createSuccessResponse(VariantResource::collection($variants));
    }

    public function createVariant(VariantRequest $request)
    {
        $variant = $this->variantService->createVariant($request);
        return ApiResponse::createSuccessResponse(new VariantResource($variant));
    }
}
