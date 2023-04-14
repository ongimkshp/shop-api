<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getProducts($limit, $page);
    public function findById($id);
    public function createProduct($attributes);
    public function updateProduct($id, $attributes);
}
