<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component {

    public $colors;

    public function mount($product) {

        $this->colors = $product->colors()->take(4)->get();

    }

}; ?>

<div class="w-full flex items-center gap-1 text-xs">
    @foreach($colors as $color)
        <div wire:key="{{ $color->id }}" class="" style="background-color:#{{$color->code}}">{{ $color->title }}</div>
        @if(!$loop->last) <span>-</span> @endif
    @endforeach
</div>
