<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart', ['products' => Product::getProductsInCart()]);
    }

    public function store(Request $request)
    {
        $cart = session('cart', [$request->id]);
        $cart[] = $request->id;
        session()->put(['cart' => array_unique($cart)]);
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $cart = session('cart', []);
        session()->put(['cart' => array_diff($cart, [$id])]);
        return redirect()->route('cart.index');
    }

}
