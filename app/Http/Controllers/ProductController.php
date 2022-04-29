<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->expectsJson()){
            return Product::all();
        }
        return view('product.index', ['products' => Product::all()]);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/images/' . $product->image_path);
        $product->delete();
        if(request()->expectsJson()){
            return response()->json(['success' => true]);
        }
        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $image = basename($request->file('image')->store('public/images'));
        $createArray = $request->validated();
        $createArray['image_path'] = $image;
        Product::create(
            $createArray
        );
        if(request()->expectsJson()){
            return response()->json(['success' => true]);
        }
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        if(request()->expectsJson()){
            return Product::findOrFail($id);
        }
        return view('product.edit', ['product' => Product::findOrFail($id)]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $updateArray = $request->validated();
        if ($request->file('image')) {
            Storage::delete('public/images/' . $product->image_path);
            $image = basename($request->file('image')->store('public/images'));
            $updateArray['image_path'] = $image;
        }
        $product->update(
            $updateArray
        );
        if(request()->expectsJson()){
            return response()->json(['success' => true]);
        }
        return redirect()->route('products.index');
    }
}
