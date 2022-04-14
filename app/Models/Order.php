<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'comments'
    ];

    public function total()
    {
        return $this->products()->sum('order_product.price');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }
}
