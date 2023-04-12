<?php

namespace App\Repositories\Interfaces;

interface CollectionRepositoryInterface
{
    public function getAll($limit, $page);
    public function findById($id);
    public function findAllProductsInCollection($id, $limit, $page);
    public function storeCollection($attributes);
}
