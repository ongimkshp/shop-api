<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Product extends Model
{
    use HasFactory, Uuids;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'product_type',
        'status',
        'vendor',
    ];

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }
}
