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

    /**
     * @OA\Get(
     * path="/api/products",
     * tags={"Products"},
     * summary="Get list of products",
     * description="Returns list of products",
     * operationId="getProducts",
     * @OA\Parameter(
     *   name="limit",
     *   in="query",
     *   description="Limit",
     *   required=false,
     *  ),
     * @OA\Parameter(
     *    name="page",
     *    in="query",
     *    description="Page",
     *    required=false,
     *    ),
     * @OA\Response(
     * response=200,
     * description="successful operation",
     *  @OA\JsonContent(
     *      type="array",
     *      @OA\Items(ref="#/components/schemas/ProductResource")
     *  ),
     * ),
     * @OA\Response(
     * response=400,
     * description="Invalid ID supplied",
     * ),
     * @OA\Response(
     * response=404,
     * description="Product not found",
     * ),
     * )
     */

    public function getProducts(Request $request)
    {
        $product = $this->productService->getProducts($request);
        return ApiResponse::createSuccessResponse(ProductResource::collection($product));
    }

    /**
     * @OA\Get(
     *   path="/api/products/{id}",
     *   tags={"Products"},
     *   summary="Get product by id",
     *   description="Returns product by id",
     *   operationId="getProductById",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Product id",
     *     @OA\Schema(
     *       type="uuid",
     *       example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
     *       )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *   )
     */
    public function getProductById($id)
    {
        $product = $this->productService->getProductById($id);
        return ApiResponse::createSuccessResponse(new ProductResource($product));
    }

    /**
     * @OA\Post(
     *   path="/api/products",
     *   tags={"Products"},
     *   summary="Create product",
     *   description="Create product",
     *   operationId="createProduct",
     *   @OA\RequestBody(
     *     description="Product object that needs to be added to the store",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation Error",
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
     *           example="The name field is required."
     *           )
     *         ),
     *      )
     *   )
     *  )
     */
    public function createProduct(ProductRequest $request)
    {
        $product = $this->productService->createProduct($request);
        return ApiResponse::createSuccessResponse(new ProductResource($product));
    }

    /**
     * @OA\Put(
     *   path="/api/products/{id}",
     *   tags={"Products"},
     *   summary="Update product",
     *   description="Update product",
     *   operationId="updateProduct",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Product id",
     *     @OA\Schema(
     *       type="uuid",
     *       example="ea9f1b1a-1b1a-11eb-adc1-0242ac120002"
     *       )
     *   ),
     *   @OA\RequestBody(
     *     description="Product object that needs to be added to the store",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation Error",
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
     *           example="The name field is required."
     *           )
     *         ),
     *     )
     *   )
     *  )
     */
    public function updateProduct($id, ProductRequest $request)
    {
        $product = $this->productService->updateProduct($id, $request);
        return ApiResponse::createSuccessResponse(new ProductResource($product));
    }
}