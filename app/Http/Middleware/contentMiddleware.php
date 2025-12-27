<?php

namespace App\Http\Middleware;

use App\Klass\CartInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class contentMiddleware
{

    public $cart;
    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function handle(Request $request, Closure $next): Response
    {

        if(!$this->cart->contentsCount()) {
            return redirect()->route('home');
        }
        return $next($request);

    }
}
