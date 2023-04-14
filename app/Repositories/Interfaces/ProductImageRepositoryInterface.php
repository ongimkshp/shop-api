<?php

namespace App\Repositories\Interfaces;

interface ProductImageRepositoryInterface
{
    public function getAllProductImages($productId);
    public function storeImage($attributes);
    public function insertImages($attributes);
}
