<?php

use App\Klass\CartInterface;
use App\Models\Color;
use App\Models\Size;
use Livewire\Volt\Component;

new class extends Component {

    public $item;
    public $qty;
    public $size;
    public $color;

    public function mount()
    {
        $this->qty = $this->item->qty;
        $this->size = Size::find($this->item->data['size']);
        $this->color = Color::find($this->item->data['color']);
    }

    public function updatedQty()
    {
        app(CartInterface::class)->changeQuantity($this->item->product, $this->qty);
        $this->js('$wire.$parent.$refresh()');
    }


    public function remove(CartInterface $cart)
    {
        $cart->remove($this->item->product);
        $this->js('$wire.$parent.$refresh()');
        $this->dispatch('refresh')->to('menu-cart');
    }
}; ?>

<div class="py-4">
    <div class="w-full space-y-2 flex flex-col md:flex-row items-start justify-between md:justify-start md:gap-10">
        <div>
            <a href="{{ route('product', $item->product) }}">
                <img class="w-32 border border-gray-300"
                     src="{{ $item->product->getFirstMediaUrl('products', 'preview') }}"
                     alt="kafshpro">

            </a>
        </div>
        <div class="grid gap-4">
            <div class="space-y-2">
                <div class="">
                    <p>{{ $item->product->title }}</p>
                </div>
                <p class="flex items-center gap-1 text-center">
                    <span>{{ number_format($item->product->price) }}</span><span>تومان</span></p>
                <p class="flex gap-1"><span>رنگ انتخابی:</span><span>{{ $color?->title ?? 'تک رنگ' }}</span></p>
                <p class="flex gap-1"><span>سایز انتخابی:</span><span>{{ $size?->title ?? 'تک سایز' }}</span></p>
            </div>
            <div class="flex items-center gap-2 md:gap-4">
                <button class="outline-none"
                        wire:click="$set('qty', {{ $qty + 1 }})">
                    <x-icons.plus class="size-7 text-emerald-500"/>
                </button>
                <p class="px-2 md:px-4 text-center">{{ $qty }}</p>
                <button class="outline-none " x-show="$wire.qty > 1"
                        x-cloak wire:click="$set('qty', {{ $qty - 1 }})">
                    <x-icons.minus class="size-7 text-red-500"/>
                </button>
                <button wire:confirm="محصول از سبد خرید حذف شود؟" class="outline-none"
                        x-show="$wire.qty == 1" x-cloak wire:click="remove">
                    <x-icons.x-mark class="size-6 text-red-500"/>
                </button>
            </div>
        </div>
    </div>
</div>
