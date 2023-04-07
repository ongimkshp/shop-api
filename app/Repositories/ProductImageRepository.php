<?php

namespace App\Repositories;

use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductImageRepositoryInterface;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    protected $model;

    public function __construct(ProductImage $model)
    {
        $this->model = $model;
    }

    public function storeImage($attributes)
    {
        $productImage = $this->model::create($attributes);
        return $productImage;
    }

    public function insertImages($attributes)
    {
        $productImage = $this->model::insert($attributes);
        return $productImage;
    }
}
