<?php

namespace App\Services;


class CartService
{
    public function addProductToCart($id)
    {
        $cart = session('cart', [$id]);
        $cart[] = $id;
        session()->put(['cart' => array_unique($cart)]);
    }

    public function removeProductFromCart($id)
    {
        $cart = session('cart', []);
        session()->put(['cart' => array_diff($cart, [$id])]);
    }
}