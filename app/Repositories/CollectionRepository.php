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

    public function getAll($limit, $page)
    {
        return $this->model->limit($limit)->offset($page * $limit)->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findAllProductsInCollection($id, $limit, $page)
    {
        return $this->model->find($id)->products->skip($page * $limit)->take($limit);
    }

    public function storeCollection($attributes)
    {
        return $this->model::create($attributes);
    }
}
