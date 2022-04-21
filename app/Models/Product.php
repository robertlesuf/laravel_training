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

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('price');
    }

    public static function getProductsInCart()
    {
        return Product::whereIn('id', session()->get('cart'))->get();
    }

    public static function getProductsNotInCart()
    {
        return Product::whereNotIn('id', session()->get('cart'))->get();
    }

    public static function deleteProductAndImage($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/images/' . $product->image_path);
        $product->delete();
    }

}
