<?php

namespace App\Repositories\Interfaces;

interface VariantRepositoryInterface
{
    public function getAllVariantsByProductId($productId);
    public function createVariant($attributes);
    public function createMultiVariant($attributes);
    public function updateVatiant($attributes, $id);
}
