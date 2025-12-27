<?php

use Livewire\Volt\Component;

new class extends Component {


    public function getCartProperty(\App\Klass\CartInterface $cart) {
        return $cart;
    }
}; ?>

<div>
    @if($this->cart->contentsCount())
        <a href="{{ route('cart') }}" class="w-full grid place-items-center focus:outline-none py-2 px-3 bg-gray-500 text-white rounded-lg">
            <span>مشاهده سبد خرید</span>
        </a>
    @endif
</div>
