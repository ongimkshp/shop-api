<?php

namespace App\Repositories;

use App\Models\ProductOption;
use App\Repositories\Interfaces\ProductOptionRepositoryInterface;

class ProductOptionRepository implements ProductOptionRepositoryInterface
{
    protected $model;

    public function __construct(ProductOption $model)
    {
        $this->model = $model;
    }

    public function createOptions($attributes)
    {
        return $this->model::insert($attributes);
    }
}
