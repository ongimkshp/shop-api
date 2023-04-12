<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Collection extends Model
{
    use HasFactory, Uuids;

    protected $table = 'collections';

    protected $fillable = [
        'title',
        'sort_order',
        'published',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'collects');
    }
}
