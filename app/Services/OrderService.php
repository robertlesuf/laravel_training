<?php

namespace App\Services;


use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;


class OrderService
{
    public function syncProducts(Collection $products, Order $order)
    {
        foreach ($products as $product) {
            $syncArray[$product->id] = ['price' => $product->price];
        }
        $order->products()->sync($syncArray);
    }
}