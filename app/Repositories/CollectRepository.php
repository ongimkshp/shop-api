<?php

namespace App\Repositories;

use App\Models\Collect;
use App\Repositories\Interfaces\CollectRepositoryInterface;

class CollectRepository implements CollectRepositoryInterface
{
    protected $model;

    public function __construct(Collect $model)
    {
        $this->model = $model;
    }

    public function storeCollect($attributes)
    {
        return $this->model::create($attributes);
    }

    public function insertCollects($collects)
    {
        return $this->model::insert($collects);
    }
}
