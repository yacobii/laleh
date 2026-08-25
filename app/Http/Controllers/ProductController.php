<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\GhorfeOnlineList;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(Request $request, GhorfeOnlineList $ghorfe)
    {
        $products = $ghorfe->products()
            ->with(['categories'])
            ->paginate($request->integer('per_page', 15));

        return ProductResource::collection($products);
    }

    public function product(GhorfeOnlineList $ghorfe, int $product)
    {
        $product = $ghorfe->products()
            ->with(['categories'])
            ->where('products.id', $product)
            ->firstOrFail();

        return new ProductResource($product);
    }
}
