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

    /**
     * @OA\Get(
     *   path="/api/products/{productId}/variants",
     *   tags={"Variants"},
     *   summary="Get list of product variants",
     *   description="Returns list of product variants",
     *   operationId="getProductVariants",
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
     *       @OA\Items(ref="#/components/schemas/VariantResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *  )
     */
    public function getProductVariants($productId)
    {
        $variants = $this->variantService->getVariantsByProductId($productId);
        return ApiResponse::createSuccessResponse(VariantResource::collection($variants));
    }

    /**
     * @OA\Post(
     *   path="/api/products/{productId}/variants",
     *   tags={"Variants"},
     *   summary="Create product variant",
     *   description="Create product variant",
     *   operationId="createProductVariant",
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
     *     required=true,
     *     description="Create product variant",
     *     @OA\JsonContent(
     *       required={"option1", "product_id"},
     *       @OA\Property(property="product_id", type="uuid", example="123e4567-e89b-12d3-a456-426655440000"),
     *       @OA\Property(property="option1", type="string", example="option1"),
     *       @OA\Property(property="option2", type="string", example="option2"),
     *       @OA\Property(property="option3", type="string", example="option3"),
     *       @OA\Property(property="price", type="string", example="12000.00"),
     *       @OA\Property(property="gram", type="string", example=null),
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/VariantResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Invalid input",
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
     *         @OA\Items(
     *           type="string",
     *           example="Option1 is required."
     *           )
     *         ),
     *       )
     *     ),
     *  )
     */
    public function createVariant(VariantRequest $request)
    {
        $variant = $this->variantService->createVariant($request);
        return ApiResponse::createSuccessResponse(new VariantResource($variant));
    }

    /**
     * @OA\Put(
     *   path="/api/products/{productId}/variants/{variantId}",
     *   tags={"Variants"},
     *   summary="Update product variant",
     *   description="Update product variant",
     *   operationId="updateProductVariant",
     *   @OA\Parameter(
     *     name="productId",
     *     in="path",
     *     description="Product ID",
     *     required=true,
     *     @OA\Schema(
     *       type="uuid",
     *       )
     *     ),
     *   @OA\Parameter(
     *     name="variantId",
     *     in="path",
     *     description="Variant ID",
     *     required=true,
     *     @OA\Schema(
     *       type="uuid",
     *       )
     *     ),
     *   @OA\RequestBody(
     *     required=true,
     *     description="Update product variant",
     *     @OA\JsonContent(
     *       @OA\Property(property="price", type="string", example="12000.00"),
     *       @OA\Property(property="gram", type="string", example=null),
     *       @OA\Property(property="quantity", type="string", example=15),
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/VariantResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Invalid input",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="message",
     *         type="string",
     *         example="Validation Error"
     *        ),
     *       @OA\Property(
     *         property="errors",
     *         type="array",
     *         @OA\Items(
     *           type="string",
     *           ),
     *         example={"Option1 is required.", "Option2 is required."}
     *         ),
     *      ),
     *   )
     *)
     */
    public function updateVariant(VariantRequest $request, $variantId)
    {
        $variant = $this->variantService->updateVariant($request, $variantId);
        return ApiResponse::createSuccessResponse(new VariantResource($variant));
    }
}
