<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Collect extends Model
{
    use HasFactory, Uuids;

    protected $table = 'collects';

    protected $fillable = [
        'collection_id',
        'product_id',
    ];
}
