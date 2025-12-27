<?php

use Livewire\Volt\Component;


new #[\Livewire\Attributes\On('refresh')] class extends Component {
    public $size;
    public ?int $selectedSize;

    public function mount()
    {
    }

    public function getCartProperty(\App\Klass\CartInterface $cart)
    {

    }


}; ?>
<div class="relative w-full">
    <button wire:click="$parent.$set('selectedSize', '{{$size->id}}')"
        @class([
    'flex-1 w-full shrink-0 focus:outline-none font-sans relative transition text-black p-2',
    'opacity-100 bg-green-500 text-white' => $this->cart,
    'text-black bg-gray-300 hover:bg-gray-200' => $size->active,
    ])>
        {{ $size->title }}


    </button>
</div>
