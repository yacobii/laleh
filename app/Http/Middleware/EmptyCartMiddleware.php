<?php

namespace App\Http\Middleware;

use App\Klass\CartInterface;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmptyCartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function __construct(protected CartInterface $cart)
    {

    }

    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->cart->contentsCount()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
