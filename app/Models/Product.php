<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image_path'
    ];

    public static function getProductsInCart()
    {
        return Product::whereIn('id', session()->get('cart',[]))->get();
    }

    public static function getProductsNotInCart()
    {
        return Product::whereNotIn('id', session()->get('cart',[]))->get();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('price');
    }

}
