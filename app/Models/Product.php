<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
        'oldPrice' => 'float',
        'supplierCost' => 'float',
        'rating' => 'float',
        'discount' => 'integer',
        'reviews' => 'integer',
        'stock' => 'integer',
        'inStock' => 'integer',
        'is_trending' => 'boolean',
        'is_featured' => 'boolean',
        'is_flash_sale' => 'boolean',
        'isTrending' => 'boolean',
        'isFeatured' => 'boolean',
        'isFlashSale' => 'boolean',
    ];

    public function categoryRel()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
}
