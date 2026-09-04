<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    protected $casts = [
        'items' => 'array',
        'deliveryCharge' => 'float',
        'subtotal' => 'float',
        'totalAmount' => 'float',
        'total_amount' => 'float',
        'supplierTotalCost' => 'float',
        'resellerProfit' => 'float',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
