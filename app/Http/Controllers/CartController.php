<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $products = Product::whereIn('id', session()->get('cart', []))->get();
        return view('cart', ['products' => $products]);
    }


    public function store(Request $request)
    {
        $cart = session()->get('cart', [$request->input('id')]);
        $cart[] = $request->input('id');
        session()->put(['cart' => array_unique($cart)]);
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $cart = session()->get('cart',[]);
        session()->put(['cart' => array_diff($cart,[$id])]);
        return redirect()->route('cart.index');
    }

}
