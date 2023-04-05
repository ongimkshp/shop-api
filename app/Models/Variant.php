<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory, Uuids;

    protected $table = 'variants';

    protected $fillable = [
        'product_id',
        'gram',
        'price',
        'option1',
        'option2',
        'option3',
    ];
}
