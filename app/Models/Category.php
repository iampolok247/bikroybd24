<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
        'showInTopCategories' => 'boolean',
        'showInSidebar' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'id');
    }
}
