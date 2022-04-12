<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function showIndex()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            $products = Product::all();
            return view('index', ['products' => $products]);
        } else {
            $products = Product::whereNotIn('id', $cart)->get();
            return view('index', ['products' => $products]);
        }

    }

    public function showCart()
    {
        $cart = session()->get('cart');
        if ($cart) {
            $products = Product::whereIn('id', $cart)->get();
            return view('cart', ['products' => $products]);
        } else {
            return view('cart');
        }
    }

    public function deleteProduct(Request $request)
    {
        $id = $request->input('id');
        $product = Product::findOrFail($id);
        Storage::delete('public/images/' . $product->image_path);
        $product->delete();
        return redirect()->route('products');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product', ['product' => $product]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        $id = $request->input('id');
        $product = Product::findOrFail($id);
        if ($request->file('image')) {
            Storage::delete('public/images/' . $product->image_path);
            $name = $request->file('image')->store('public/images');
            $name = explode('/', $name);
            $name = end($name);
            $product->image_path = $name;
        }
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('products');
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $name = $request->file('image')->store('public/images');
        $name = explode('/', $name);
        $name = end($name);
        $product = new Product();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->image_path = $name;
        $product->save();
        return redirect()->route('products');
    }

    public function showAll()
    {
        $products = Product::all();
        return view('products', ['products' => $products]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart');
        if (!$cart) {
            $cart = [$id];
            session(['cart' => $cart]);
        } else {
            if (!in_array($id, $cart)) {
                $cart[] = $id;
                session(['cart' => $cart]);
            }
        }
        return redirect()->route('index');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function removeFromCart(Request $request)
    {
        $id = $request->input('id');
        $cart = session()->get('cart');
        if (($key = array_search($id, $cart)) !== false) {
            unset($cart[$key]);
            session(['cart' => $cart]);
        }
        return redirect()->route('cart');
    }

    public function addProduct()
    {
        return view('add');
    }
}
