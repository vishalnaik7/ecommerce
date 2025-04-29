<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price','user_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class);
}

public function items()
{
    return $this->has(OrderItem::class);
}   
}
