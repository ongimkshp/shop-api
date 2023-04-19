<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CollectionRequest;
use App\Http\Services\CollectionService;
use App\Http\Resources\CollectionResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    /**
     * @OA\Get(
     *   path="/api/collections",
     *   tags={"Collections"},
     *   summary="Get list of collections",
     *   description="Returns list of collections",
     *   operationId="getCollections",
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page number",
     *     required=false,
     *     @OA\Schema(
     *       type="integer",
     *       )
     *     ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Limit number",
     *     required=false,
     *     @OA\Schema(
     *       type="integer",
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/CollectionResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *  )
     */
    public function getCollections(Request $request)
    {
        $collections = $this->collectionService->getCollections($request);
        return ApiResponse::createSuccessResponse(CollectionResource::collection($collections));
    }

    /**
     * @OA\Get(
     *   path="/api/collections/{id}",
     *   tags={"Collections"},
     *   summary="Get collection by id",
     *   description="Returns collection by id",
     *   operationId="getCollectionById",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Collection ID",
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
     *       @OA\Items(ref="#/components/schemas/CollectionResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *  )
     */
    public function getCollectionById($id)
    {
        $collection = $this->collectionService->getCollectionById($id);
        return ApiResponse::createSuccessResponse(new CollectionResource($collection));
    }

    /**
     * @OA\Get(
     *   path="/api/collections/{id}/products",
     *   tags={"Collections"},
     *   summary="Get products in collection",
     *   description="Returns products in collection",
     *   operationId="getProductsInCollection",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="Collection ID",
     *     required=false,
     *     @OA\Schema(
     *       type="uuid",
     *       )
     *     ),
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="Page number",
     *     required=false,
     *     @OA\Schema(
     *       type="integer",
     *       )
     *     ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Limit number",
     *     required=false,
     *     @OA\Schema(
     *       type="integer",
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/ProductResource")
     *       )
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *  )
     */
    public function getProductsInCollection(Request $request, $id)
    {
        $products = $this->collectionService->getProductsInCollection($request, $id);
        return ApiResponse::createSuccessResponse(ProductResource::collection($products));
    }

    /**
     * @OA\Post(
     *   path="/api/collections",
     *   tags={"Collections"},
     *   summary="Create collection",
     *   description="Create collection",
     *   operationId="createCollection",
     *   @OA\RequestBody(
     *     description="Collection object that needs to be added",
     *     required=true,
     *     @OA\JsonContent(ref="#/components/schemas/CollectionRequest")
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(
     *       type="array",
     *       @OA\Items(ref="#/components/schemas/CollectionResource")
     *       )
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
     *       required={"message", "errors"},
     *       @OA\Property(property="message", type="string", example="Validation Error."),
     *       @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The name field is required."}),
     *       )
     *     ),
     *  )
     */
    public function createCollection(CollectionRequest $request)
    {
        $collection = $this->collectionService->createCollection($request);
        return ApiResponse::createSuccessResponse(new CollectionResource($collection));
    }
}
