<?php

use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {

    public Product $product;

    #[\Livewire\Attributes\Validate('required|integer')]
    public $rate;

    public function add_discount()
    {
        $this->validate();

        $discountRate = $this->rate / 100; // Convert percentage to decimal
        $this->product->price_with_discount = $this->product->price * (1 - $discountRate);
        $this->product->rate = $this->rate;
        $this->product->discounted = 1;
        $this->product->save();
        $this->reset('rate');
$this->js('$wire.$parent.$refresh()');

    }
    public function remove_discount()
    {

        $this->product->price_with_discount = $this->product->price;
        $this->product->rate = null;
        $this->product->discounted = 0;
        $this->product->save();
        $this->js('$wire.$parent.$refresh()');


    }
}; ?>

<div class="flex items-center">
    <input class="h-9 w-full" type="text" wire:model="rate" placeholder="تخفیف این محصول">
    <button wire:click="add_discount" class="h-9 bg-gray-800 text-white outline-none px-4">ثبت</button>
    <button wire:click="remove_discount" class="outline-none text-red-500 pr-4" wire:confirm="">x</button>
</div>
