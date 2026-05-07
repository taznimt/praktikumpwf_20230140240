<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Field yang boleh diisi
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        // 1 category punya banyak product
        return $this->hasMany(Product::class);
    }
}