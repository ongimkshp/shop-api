<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CollectRequest;
use App\Http\Services\CollectService;
use App\Http\Resources\CollectResource;

class CollectController extends Controller
{
    protected $collectService;

    public function __construct(CollectService $collectService)
    {
        $this->collectService = $collectService;
    }

    /**
     * @OA\Post(
     *   path="/api/collects",
     *   tags={"Collect"},
     *   summary="Add product to collection",
     *   description="Add product to collection",
     *   operationId="addProductToCollection",
     *   @OA\RequestBody(
     *     description="Product object that needs to be added to collection",
     *     required=true,
     *     @OA\JsonContent(
     *       required={"product_id, collection_id"},
     *       @OA\Property(property="product_id", type="uuid", example="c0a80121-7ac0-18d3-8e47-000000000000"),
     *       @OA\Property(property="collection_id", type="uuid", example="c0a80121-7ac0-18d3-8e47-000000000000"),
     *       )
     *     ),
     *   @OA\Response(
     *     response=200,
     *     description="successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CollectResource")
     *     ),
     *   @OA\Response(
     *     response=400,
     *     description="Invalid ID supplied",
     *     ),
     *   @OA\Response(
     *     response=404,
     *     description="Collection not found",
     *     ),
     *   @OA\Response(
     *     response=422,
     *     description="Validation Error",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(property="message", type="string", example="The given data was invalid."),
     *       @OA\Property(property="errors", type="array", @OA\Items(type="string"), example={"The product id field is required.", "The collection id field is required."}),
     *     )
     *     ),
     *  )
     */
    public function addProductToCollection(CollectRequest $request)
    {
        $collect = $this->collectService->createCollect($request);

        return ApiResponse::createSuccessResponse(new CollectResource($collect));
    }
}
