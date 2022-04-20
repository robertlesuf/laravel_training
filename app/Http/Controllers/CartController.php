<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        return view('cart', ['products' => Product::whereIn('id', session()->get('cart', []))->get()]);
    }

    public function store(Request $request)
    {
        $cart = session('cart', [$request->input('id')]);
        $cart[] = $request->input('id');
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
