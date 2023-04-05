<?php

namespace App\Repositories\Interfaces;

interface VariantRepositoryInterface
{
    public function createVariant($attributes);
    public function createMultiVariant($attributes);
}
