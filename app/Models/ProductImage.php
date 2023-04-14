<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class ProductImage extends Model
{
    use HasFactory, Uuids;

    protected $table = 'product_images';

    protected $casts = [
        'variant_ids' => 'array'
    ];

    protected $fillable = [
        'product_id',
        'variant_ids',
        'src',
        'position',
        'width',
        'height',
    ];
}
