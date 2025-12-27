<?php

use App\Http\Controllers\AppController;
use App\Livewire\Actions\Logout;
use App\Livewire\Checkout;
use App\Livewire\ContactPage;
use App\Livewire\Favs;
use App\Livewire\Front\CategoryProducts;
use App\Livewire\Kart;
use App\Livewire\ProductComponent;
use App\Livewire\Profile;
use App\Models\Product;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;


Route::get('/', \App\Livewire\Main::class)->name('home');



Route::get('/category/{category:slug}/products', CategoryProducts::class)->name('category.products');
Route::get('/product/{product:slug}', ProductComponent::class)->name('product');
Route::get('/products', \App\Livewire\Front\Products::class)->name('products');
Route::get('/categories/{category:slug}', \App\Livewire\Categories::class)->name('categories');

Route::get('/cart', Kart::class)->middleware(['auth', 'cart_count'])->name('cart');

Route::get('/contact', ContactPage::class)->name('contact');

Route::get('/checkout/{order}', Checkout::class)->middleware(['auth'])->name('checkout');

Route::get('/profile', Profile::class)->name('profile')->middleware('auth');

Route::get('/faq', \App\Livewire\Faq::class)->name('faq');
Route::get('/buy-guide', \App\Livewire\RahnamaKharid::class)->name('kharid');
Route::get('/order-guide', \App\Livewire\RahnamaOrder::class)->name('sefaresh');
Route::get('/return-guide', \App\Livewire\Marjoee::class)->name('marjoee');
Route::get('/about-us', \App\Livewire\AboutUs::class)->name('about-us');



Route::get('/favs',Favs::class)->middleware(['auth'])->name('favs');

Route::get('/export', [AppController::class, 'export'])->name('export');

Route::get('login', \App\Livewire\AuthSystem::class)->name('login');
Route::get('logout', Logout::class)->name('logout');

Route::get('sp/clear', function () {
    Artisan::call('optimize:clear');
    return 'CLEARED';
});

Route::get('sp/optimize', function () {
    Artisan::call('optimize');
    return 'OPTIMIZED';
});

Route::get('sitemap', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('products'))
        ->add(Url::create('contact'))
        ->add(Product::all())
        ->writeToFile('./sitemap.xml');

    return "SITEMAP CREATED";
});







//require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/remote.php';


