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

    public function destroy(Request $request)
    {
        $cart = session()->get('cart',[]);
        array_splice($cart,array_search($request->input('id'),$cart),1);
        session()->put(['cart' => $cart]);
        return redirect()->route('cart.index');
    }

}
