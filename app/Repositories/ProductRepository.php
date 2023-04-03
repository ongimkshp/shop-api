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

    public function getAllProducts()
    {
        return $this->model::all();
    }

    public function getProductById($id)
    {
        return $this->model::findOrfail($id);
    }

    public function createProduct($attributes)
    {
        return $this->model::create($attributes);
    }
}
