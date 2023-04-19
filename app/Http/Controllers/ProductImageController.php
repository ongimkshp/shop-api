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

    /**
     * @OA\Get(
     *   path="/api/products/{productId}/images",
     *   tags={"Product Images"},
     *   summary="Get list of product images",
     *   description="Returns list of product images",
     *   operationId="getProductImages",
     *   @OA\Parameter(
     *     name="productId",
     *     in="path",
     *     description="Product ID",
     *     required=true,
     *     @OA\Schema(
     *       type="uuid",
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/ProductImageResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *  )
     */
    public function getProductImages($productId)
    {
        $images = $this->productImageService->getProductImages($productId);
        return ApiResponse::createSuccessResponse(ProductImageResource::collection($images));
    }

    /**
     * @OA\Post(
     *   path="/api/products/{productId}/images",
     *   tags={"Product Images"},
     *   summary="Create product image",
     *   description="Create product image",
     *   operationId="createProductImage",
     *   @OA\Parameter(
     *     name="productId",
     *     in="path",
     *     description="Product ID",
     *     required=true,
     *     @OA\Schema(
     *       type="uuid",
     *       )
     *     ),
     *   @OA\RequestBody(
     *     description="Product image object that needs to be added to the store",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ProductImageRequest")
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/ProductImageResource")
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *   @OA\Response(
     *     response=404,
     *     description="Product not found",
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation error",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Validation Error"
     *         ),
     *       @OA\Property(
     *         property="errors",
     *         type="array",
     *         example={"The image field is required.", "The product id field is required."},
     *         @OA\Items(
     *           type="string",
     *           example="The image field is required."
     *           )
     *         ),
     *      ),
     *    ),
     *)
     */
    public function createProductImage(ProductImageRequest $request)
    {
        $image = $this->productImageService->createProductImage($request);
        return ApiResponse::createSuccessResponse(new ProductImageResource($image));
    }
}
