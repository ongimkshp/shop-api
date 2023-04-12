<?php

namespace App\Repositories\Interfaces;

interface CollectRepositoryInterface
{
    public function storeCollect($attributes);

    public function insertCollects($collects);
}
