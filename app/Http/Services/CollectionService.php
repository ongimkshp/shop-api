<?php

namespace App\Http\Services;

use App\Repositories\CollectionRepository;

class CollectionService
{
    private const DEFAULT_LIMIT = 100;
    private const DEFAULT_PAGE = 0;
    private $collectionRepo;
    private $collectService;

    public function __construct(CollectionRepository $collectionRepo, CollectService $collectService)
    {
        $this->collectionRepo = $collectionRepo;
        $this->collectService = $collectService;
    }

    protected function getParams($request)
    {
        $params = $request->only('limit', 'page');
        $limit = $params['limit'] ?? self::DEFAULT_LIMIT;
        $page = $params['page'] ?? self::DEFAULT_PAGE;
        return [$limit, $page];
    }

    public function getCollections($request)
    {
        [$limit, $page] = $this->getParams($request);
        return $this->collectionRepo->getAll($limit, $page);
    }

    public function getCollectionById($id)
    {
        return $this->collectionRepo->findById($id);
    }

    public function getProductsInCollection($request, $id)
    {
        [$limit, $page] = $this->getParams($request);
        return $this->collectionRepo->findAllProductsInCollection($id, $limit, $page);
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
