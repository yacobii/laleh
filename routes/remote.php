<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('remote')->group(function () {
   Route::get('/users', function () {
     return \App\Models\User::all();
   });

    Route::get('/categories', function () {
        return \App\Models\Category::all();
    });

    Route::get('/colors', function () {
        return \App\Models\Color::all();
    });

    Route::get('/sizes', function () {
        return \App\Models\Size::all();
    });


    Route::get('/products', function () {
        return \App\Models\Product::all();
    });





    Route::get('/media', function () {
        return \Illuminate\Support\Facades\DB::table('media')->get();
    });



    Route::get('/color_product', function () {
        return \Illuminate\Support\Facades\DB::table('color_product')->get();
    });


    Route::get('/product_size', function () {
        return \Illuminate\Support\Facades\DB::table('product_size')->get();
    });

    Route::get('/texts', function () {
        return DB::table('texts')->get();
    });

    Route::get('/orders', function () {
        return DB::table('orders')->get();
    });

    Route::get('/items', function () {
        return DB::table('items')->get();
    });

    Route::get('/coupons', function () {
        return DB::table('coupons')->get();
    });
});
