<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'name',
        'contact',
        'comments'
    ];

    public static function getAllTotals()
    {
        return Order::selectRaw('SUM(order_product.price) as total, `name`')->leftJoin('order_product',
            'order_product.order_id', '=', 'orders.id')->groupBy('orders.id')->get();
    }

    public function total()
    {
        return $this->products()->sum('order_product.price');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }
}
