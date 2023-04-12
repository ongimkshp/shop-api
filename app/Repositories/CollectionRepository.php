<?php

namespace App\Repositories;

use App\Models\Collection;
use App\Repositories\Interfaces\CollectionRepositoryInterface;

class CollectionRepository implements CollectionRepositoryInterface
{
    protected $model;

    public function __construct(Collection $model)
    {
        $this->model = $model;
    }

    public function storeCollection($attributes)
    {
        return $this->model::create($attributes);
    }
}
