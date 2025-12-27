<?php

use Livewire\Volt\Component;
use App\Klass\CartInterface;
use App\Models\Order;

new class extends Component {

    public $variation;
    public $qty;


    public function mount()
    {

        $this->variation->load('stocks');
        $this->qty = $this->variation->pivot->qty ?? 1;
        $this->dispatch('qty', ['qty' => $this->qty])->to('checkout');
    }


    public function getCartProperty(CartInterface $cart)
    {
        return $cart;
    }

    public function updatedQty()
    {
        app(CartInterface::class)->changeQuantity($this->variation, $this->qty);
        $this->dispatch('refresh')->to('checkout');
        $this->dispatch('refresh')->self();
    }

    public function remove(CartInterface $cart)
    {

        $cart->remove($this->variation);
        $this->dispatch('refresh')->self();
//        $this->dispatch('refresh')->to('checkout');
        $this->js('$wire.$parent.$refresh()');
    }


}; ?>

<div>

    <div class="w-full flex flex-col md:flex-row items-center justify-between pt-4">
        <div class="flex items-center gap-x-6">
            @if($variation->stockCount() > $qty)
                <button class="focus:outline-none w-20 grid place-items-center p-1 border rounded-md"
                        wire:click.prevent="$set('qty', {{$qty + 1}})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-green-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                </button>
            @endif
            <p class="text-2xl">{{ $qty }}</p>

            <button @disabled($qty <= 1)

                    class="disabled:opacity-25 focus:outline-none w-20 grid place-items-center p-1 border rounded-md"
                    wire:click="$set('qty', {{ $qty - 1 }})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="w-6 h-6 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15"/>
                    </svg>


                </button>

            <button class="focus:outline-none w-20 grid place-items-center p-1 border rounded-md"
                    wire:click="remove">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>

            </button>
        </div>

    </div>

</div>
