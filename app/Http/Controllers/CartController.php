<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        return view('cart', ['products' => Product::getProductsInCart()]);
    }

    public function store(Request $request)
    {
        $this->cartService->addProductToCart($request->id);
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $this->cartService->removeProductFromCart($id);
        return redirect()->route('cart.index');
    }

}
