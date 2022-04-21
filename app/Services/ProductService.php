<?php

namespace App\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function storeImage(ProductStoreRequest $request)
    {
        return basename($request->file('image')->store('public/images'));
    }

    public function replaceImageOnUpdate(ProductUpdateRequest $request,$current_path)
    {
        if ($request->file('image')) {
            Storage::delete('public/images/' . $current_path);
            $name = basename($request->file('image')->store('public/images'));
            return $name;
        }
        return $current_path;
    }

    public function getCreateArray($image, $request)
    {
        $createArray = $request->validated();
        $createArray['image_path'] = $image;
        return $createArray;
    }

}