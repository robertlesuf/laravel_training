<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return Product::whereNotIn('id', session()->get('cart', []))->get()->toJson();
        }
        return view('spa');
    }
}
