<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return view('products', ['products' => Product::all()]);
    }

    public function destroy($id)
    {
        $this->productService->deleteProductAndImage($id);
        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('create');
    }

    public function store(ProductStoreRequest $request)
    {
        Product::create(
            $this->productService->getProductArray($this->productService->storeImage($request), $request)
        );
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        return view('product', ['product' => Product::findOrFail($id)]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $product->update(
            $this->productService->getProductArray($this->productService->replaceImageOnUpdate($request,
                $product->image_path), $request)
        );
        return redirect()->route('products.index');
    }

}
