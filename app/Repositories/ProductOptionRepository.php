<?php

namespace App\Repositories;

use App\Models\ProductOption;
use App\Repositories\Interfaces\ProductOptionRepositoryInterface;

class ProductOptionRepository extends BaseRepository implements ProductOptionRepositoryInterface
{

    public function getModel()
    {
        return ProductOption::class;
    }
    public function createOption($attributes)
    {
        return $this->model::create($attributes);
    }
}
