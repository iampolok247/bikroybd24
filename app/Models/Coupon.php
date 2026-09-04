<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $casts = [
        'discountValue' => 'float',
        'discount_amount' => 'float',
        'minSpend' => 'float',
        'usageLimit' => 'integer',
        'usageCount' => 'integer',
        'is_active' => 'boolean',
        'expiresAt' => 'datetime',
    ];
}
