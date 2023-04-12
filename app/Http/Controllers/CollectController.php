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

    public function addProductToCollection(CollectRequest $request)
    {
        $collect = $this->collectService->createCollect($request);

        return ApiResponse::createSuccessResponse(new CollectResource($collect));
    }
}
