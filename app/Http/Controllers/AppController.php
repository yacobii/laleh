<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Models\About;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AppController extends Controller
{
    public function __invoke()
    {



        return view('main');
    }


    public function products()
    {
        $products = Product::query()
            ->with('variations', 'variations.parent.media')
            ->where('active', true)
            ->orderBy('order')
            ->get();

        return view('products', compact('products'));
    }




    public function export()
    {
        $name = 'products-'.now().'.xlsx';
        return Excel::download(new ProductsExport(), $name);
    }

    public function users_export()
    {
        $name = 'users-'.now()->format('Y-m-d-h-i-s').'.xlsx';
        return Excel::download(new UsersExport, $name);
    }

}
