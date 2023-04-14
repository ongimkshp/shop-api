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

    public function getCollections(Request $request)
    {
        $collections = $this->collectionService->getCollections($request);
        return ApiResponse::createSuccessResponse(CollectionResource::collection($collections));
    }

    public function getCollectionById($id)
    {
        $collection = $this->collectionService->getCollectionById($id);
        return ApiResponse::createSuccessResponse(new CollectionResource($collection));
    }

    public function getProductsInCollection(Request $request, $id)
    {
        $products = $this->collectionService->getProductsInCollection($request, $id);
        return ApiResponse::createSuccessResponse(ProductResource::collection($products));
    }

    public function createCollection(CollectionRequest $request)
    {
        $collection = $this->collectionService->createCollection($request);
        return ApiResponse::createSuccessResponse(new CollectionResource($collection));
    }
}
