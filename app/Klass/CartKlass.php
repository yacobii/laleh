<?php

namespace App\Klass;

use App\Models\Cart;
use Illuminate\Session\SessionManager;


class CartKlass implements CartInterface
{
    protected $instance;
    private const CART_SESSION_KEY = 'temp';

    public function __construct(protected SessionManager $session)
    {
    }



    public function add($product, $data)
    {
        $cart = $this->instance();

        $existingItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            $existingItem->update([
                'data' => $data
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'qty' => 1,
                'data' => $data,
            ]);
        }
    }





    public function remove($product)
    {
        $cart = $this->instance();

        $cartItem = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }
    }

    public function total()
    {
        return $this->instance()->items->reduce(function ($carry, $item) {
            return $carry + ($item->data['price'] * $item->qty);
        }, 0);
    }

    public function clearCart()
    {
        $this->instance()->items()->delete();
        $this->clearInstanceCache();
    }

    public function changeQuantity($product, $qty)
    {
        $cartItem = $this->instance()->items()
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update(['qty' => $qty]);
        }
    }


    protected function clearInstanceCache()
    {
        $this->instance = null;
    }

    public function isEmpty(): bool
    {
        return $this->contents()->count() === 0;
    }

    public function contents()
    {
        return $this->instance()->items()->with('product')->get();
    }


    public function contentsCount()
    {
        return $this->contents()?->count();
    }


    protected function instance()
    {
        if ($this->instance) {
            return $this->instance;
        }

        // Fetch the cart based on the session
        $cart = Cart::query()
            ->with('items') // Load cart items
            ->where('uuid', $this->session->get(self::CART_SESSION_KEY))
            ->first();

        // If the cart is not found, create a new one
        if (!$cart) {
            $cart = Cart::create(); // Create a new cart if none exists
            $this->session->put(self::CART_SESSION_KEY, $cart->uuid);
        }

        // If the user is logged in, associate the cart with the user
        if (auth()->check()) {
            $cart->user_id = auth()->id();
            $cart->save();
        }

        return $this->instance = $cart;
    }


}
