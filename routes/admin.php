<?php


use App\Livewire\Admin\Accessories\Accessories;
use App\Livewire\Admin\Analysis\SalesPanel;
use App\Livewire\Admin\Orders\Orders;
use App\Livewire\Admin\Products\Add;
use App\Livewire\Admin\Products\Products;
use App\Livewire\Admin\Users\Users;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::prefix('admin')->middleware(['auth','permission:admin'])->group(function () {
    Route::get('/', Orders::class)->name('admin.orders');

    Route::get('/admin-products', Products::class)->name('admin.products');

    Route::get('/category/{category}/product/add', \App\Livewire\Admin\Categories\AddProduct::class)->name('admin.category.product.add');

    Route::get('/accessories', Accessories::class)->name('admin.accessories');
    Route::get('/product/{product}/edit', \App\Livewire\Admin\Products\Edit::class)->name('admin.product.edit');
    Route::get('/product/add', Add::class)->name('admin.product.add');

    Route::get('/categories', \App\Livewire\Admin\Categories\Categories::class)->name('admin.categories');
    Route::get('/categories/edit/{category}', \App\Livewire\Admin\Categories\Edit::class)->name('admin.categories.edit');


    Route::get('/sizes', \App\Livewire\Admin\Size\Sizes::class)->name('admin.sizes');
    Route::get('/colors', \App\Livewire\Admin\Colors\Colors::class)->name('admin.colors');
    Route::get('/colors/edit/{variation}', \App\Livewire\Admin\Products\ColorsEdit::class)->name('colors.edit');
    Route::get('/colors/products/{product}', \App\Livewire\Admin\Products\Colors::class)->name('product.colors');
    Route::get('/sizes/products/{product}', \App\Livewire\Admin\Products\Sizes::class)->name('product.sizes');
    Route::get('/gallery/products/{product}', \App\Livewire\Admin\Products\Gallery::class)->name('product.gallery');
    Route::get('/ai/products/{product}', \App\Livewire\Admin\Products\AiImageGenerator::class)->name('product.ai');


    Volt::route('/tables/product/{product}', '/admin/products/tables/index')->name('admin.product.tables');

    Route::get('/edit/posts/{post}', \App\Livewire\Admin\Posts\Edit::class)->name('admin.posts.edit');


    Route::get('/order/{order}', \App\Livewire\Admin\Orders\SingleOrder::class)->name('admin.order');



    Route::get('/users', Users::class)->name('admin.users');
    Route::get('/logout', \App\Livewire\Actions\Logout::class)->name('admin.logout');

    Route::get('/excel', \App\Livewire\Excel::class)->name('admin.excel');

    Route::get('users/export/', [\App\Http\Controllers\AppController::class, 'users_export'])->name('users.export');

    Route::get('/super', \App\Livewire\Super\Commands::class)->name('super.commands');

    Route::get('posts', \App\Livewire\Admin\Posts\Posts::class)->name('admin.posts');
    Route::get('posts/edit/{post}', \App\Livewire\Admin\Posts\Edit::class)->name('admin.posts.edit');

    /* Coupons */
    Route::get('/coupons/create', \App\Livewire\Admin\Coupons\Add::class)->name('admin.coupons.add');
    Route::get('/coupons', \App\Livewire\Admin\Coupons\Coupons::class)->name('admin.coupons');
    Route::get('/coupons/edit/{coupon}', \App\Livewire\Admin\Coupons\Edit::class)->name('admin.coupons.edit');


    /* Texts */
    Route::get('/texts', \App\Livewire\Admin\Texts\Texts::class)->name('admin.texts');
    Route::get('/texts/edit/{text}', \App\Livewire\Admin\Texts\Edit::class)->name('admin.texts.edit');


    Route::get('/sales', SalesPanel::class)->name('admin.sales');

});


//Route::prefix('admin')->middleware('permission:admin')->group(function () {
//    Route::get('/order/{order}', \App\Livewire\Admin\Orders\SingleOrder::class)->name('admin.order');
//    Route::get('/orders/failed', \App\Livewire\Admin\Orders\Failed::class)->name('admin.orders.failed');
//    Route::get('/orders/snapp', \App\Livewire\Admin\Orders\Snapp::class)->name('admin.orders.snapp');
//    Route::get('/orders/kart', \App\Livewire\Admin\Orders\Kart::class)->name('admin.orders.kart');
//    Route::get('/orders/dargah', \App\Livewire\Admin\Orders\Dargah::class)->name('admin.orders.dargah');
//    Route::get('/orders/success', \App\Livewire\Admin\Orders\Success::class)->name('admin.orders.success');
//    Route::get('/orders/sales', \App\Livewire\Admin\Sales\Sales::class)->name('admin.orders.sales');
//});
