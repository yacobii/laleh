<?php

namespace App\Providers;

use App\Klass\CartInterface;
use App\Klass\CartKlass;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CartInterface::class, function (){
            return new CartKlass(session());
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
