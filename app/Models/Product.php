<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Field yang boleh diisi
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'qty',
        'price',
    ];

    public function user()
    {
        // 1 product dimiliki oleh 1 user
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        // 1 product dimiliki oleh 1 category
        return $this->belongsTo(Category::class);
    }
}