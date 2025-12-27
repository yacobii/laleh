<?php

use App\Klass\CartInterface;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new  #[On('refresh')] class extends Component {


    public function getCartProperty(CartInterface $cart)
    {
        return $cart;
    }

}; ?>

<div class="flex items-center gap-4">
    @if($this->cart->contentsCount())
        <a href="{{ route('cart') }}" class="flex items-center gap-2">
            <x-icons.cart class="size-4" />
            <p class="size-5 text-sm bg-red-500 text-white grid place-items-center">
                {{ $this->cart->contentsCount() }}
            </p>
        </a>
    @endif
</div>

