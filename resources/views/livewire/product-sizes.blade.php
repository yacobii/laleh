<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component {

    public $sizes;

    public function mount($product) {

        $this->sizes = $product->sizes()->take(4)->get();

    }

}; ?>

<div class="w-full flex items-center gap-1 text-xs">
    @foreach($sizes as $size)
        <div wire:key="{{ $size->id }}" class="">{{ $size->title }}</div>
        @if(!$loop->last) <span>-</span> @endif
    @endforeach
</div>
