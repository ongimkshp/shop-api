<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\CollectionRequest;
use App\Http\Services\CollectionService;
use App\Http\Resources\CollectionResource;

class CollectionController extends Controller
{

    private $collectionService;

    public function __construct(CollectionService $collectionService)
    {
        $this->collectionService = $collectionService;
    }

    public function createCollection(CollectionRequest $request)
    {
        $collection = $this->collectionService->createCollection($request);
        return ApiResponse::createSuccessResponse(new CollectionResource($collection));
    }
}
