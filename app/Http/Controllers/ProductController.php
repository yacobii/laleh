<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function products()
    {
        return ProductResource::collection(Product::query()
            ->with('categories')
            ->latest()->paginate());
    }

    public function product(Product $product)
    {
        $product->load('categories');

        return new ProductResource($product);
    }
}
