<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getProducts($limit, $page)
    {
        return $this->model->with(['options', 'variants', 'images'])->limit($limit)->offset($page * $limit)->get();
    }

    public function findById($id)
    {
        return $this->model->with(['options', 'variants', 'images'])->find($id);
    }

    public function createProduct($attributes)
    {
        return $this->model::create($attributes);
    }
}
