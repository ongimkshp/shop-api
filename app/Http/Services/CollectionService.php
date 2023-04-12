<?php

namespace App\Http\Services;

use App\Repositories\CollectionRepository;

class CollectionService
{
    private $collectionRepo;
    private $collectService;

    public function __construct(CollectionRepository $collectionRepo, CollectService $collectService)
    {
        $this->collectionRepo = $collectionRepo;
        $this->collectService = $collectService;
    }

    public function createCollection($request)
    {
        $attributes = $request->only(['title', 'sort_order', 'published']);
        $productIds = $request->product_ids;
        $collection = $this->collectionRepo->storeCollection($attributes);
        $this->collectService->createMultipleCollects($productIds, $collection->id);

        return $collection;
    }
}
