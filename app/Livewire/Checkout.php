<?php

namespace App\Livewire;

use App\Klass\CartInterface;
use App\Klass\CartKlass;
use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class Checkout extends Component
{

    public Order $order;


    public function mount(CartInterface $cart)
    {
        $cart->clearCart();         // Detach all items (variations) from cart
        $this->dispatch('refresh')->to('menu-cart');
    }


    public function dilitOrder()
    {
        $this->order->delete();
        app(CartKlass::class)->clearCart();
        return $this->redirect(route('cart'));
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.checkout');
    }
}
