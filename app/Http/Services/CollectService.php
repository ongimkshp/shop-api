<?php

namespace App\Http\Services;

use App\Repositories\CollectRepository;
use Illuminate\Support\Str;

class CollectService
{
    private $collectRepo;

    public function __construct(CollectRepository $collectRepo)
    {
        $this->collectRepo = $collectRepo;
    }

    public function createCollect($request)
    {
        $attributes = $request->only(['collection_id', 'product_id']);
        $collect = $this->collectRepo->storeCollect($attributes);
        return $collect;
    }

    public function createMultipleCollects($productIds, $collectionId)
    {
        $collects = array_map(function ($productId) use ($collectionId) {
            return [
                'id' => Str::uuid(),
                'collection_id' => $collectionId,
                'product_id' => $productId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $productIds);
        $collects = $this->collectRepo->insertCollects($collects);
        return $collects;
    }
}
