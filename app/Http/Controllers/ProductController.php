<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/images/' . $product->image_path);
        $product->delete();
        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $name = $request->file('image')->store('public/images');
        $name = basename($name);
        Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $name,
            'price' => $request->input('price'),
        ]);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        return view('product', ['product' => Product::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);
        $product = Product::find($id);
        if ($request->file('image')) {
            Storage::delete('public/images/' . $product->image_path);
            $name = $request->file('image')->store('public/images');
            $name = basename($name);
        }
        $product->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image_path' => $name ?? $product->image_path,
            'price' => $request->input('price'),
        ]);
        return redirect()->route('products.index');
    }

}
