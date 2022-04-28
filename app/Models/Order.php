<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public static function getOrdersAndTotals()
    {
        return Order::select('orders.*', DB::raw('Sum(order_product.price) as total'))->leftJoin('order_product',
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
