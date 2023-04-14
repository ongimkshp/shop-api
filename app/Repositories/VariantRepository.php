<?php

namespace App\Repositories;

use App\Models\Variant;
use App\Repositories\Interfaces\VariantRepositoryInterface;

class VariantRepository implements VariantRepositoryInterface
{
    protected $model;

    public function __construct(Variant $model)
    {
        $this->model = $model;
    }

    public function getAllVariantsByProductId($productId)
    {
        return $this->model->where('product_id', $productId)->get();
    }

    public function createVariant($attributes)
    {
        return $this->model::create($attributes);
    }

    public function createMultiVariant($attributes)
    {
        return $this->model::insert($attributes);
    }
}
