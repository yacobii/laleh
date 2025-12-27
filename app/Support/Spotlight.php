<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class Spotlight
{

    public function search(Request $request)
    {

        return Product::query()
            ->where('active', true)
            ->where('title', 'like',  "%$request->search%")
            ->take(5)
            ->get()
            ->map(function (Product $product) {
                return [
                    'avatar' => $product->getFirstMediaUrl('products', 'preview') ?? '/assets/loader.jpg',
//                    'icon' => Blade::render("<x-icon name='o-bolt' />"),
                    'name' => $product->title,
                    'description' => '',
                    'link' => "/product/$product->slug"
                ];
            });

    }

}
