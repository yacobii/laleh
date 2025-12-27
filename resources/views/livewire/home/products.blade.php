<?php

use App\Models\Product;
use Livewire\Volt\Component;

new class extends Component {

    #[\Livewire\Attributes\Computed]
    public function products()
    {
        return Product::active()->limit(15)->inRandomOrder()->get();
    }

}; ?>

<div class="mx-auto size bg-white">
    <div class="grid grid-cols-2 md:grid-cols-5 gap-x-5 divide-y">
        @foreach($this->products as $product)
            <div wire:key="{{ $product->id }}" class="text-sm py-8 h-full">
                <div class="group relative">
                    <img
                        class="w-full object-cover aspect-square transition-opacity duration-300 ease-in-out group-hover:opacity-0"
                        src="{{ $product->getFirstMediaUrl('products', 'cover') }}"
                        alt="{{ $product->title }}">
                    <img
                        class="w-full object-cover aspect-square absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
                        src="{{ $product->getMedia('products')?->get(1)?->getUrl('preview') ?? asset('fallback/fallback-slider.jpg') }}"
                        alt="{{ $product->title }}">

                    @if(!is_null($product->discount_rate))
                        <p class="absolute top-3 right-0 flex gap-1 bg-red-500 rounded-l-2xl text-white text-sm p-2">
                            <span>تخفیف</span>
                            <span>{{ $product->discount_rate }}</span>
                            <span>درصد</span>
                        </p>
                    @endif
                </div>
                <div class="mt-4">
                    <h2 class="font-bold h-12">{{ $product->title }}</h2>

                    <div class="mt-8 text-center grid gap-3">
                        @if(is_null( $product->discount_rate))
                            <p class="text-sm">{{ number_format($product->price) }} <span class="text-xs">تومان</span></p>
                            @else
<div>
    <p class="text-sm line-through">{{ number_format($product->price) }} <span class="text-xs">تومان</span></p>
    <p class="text-sm">{{ number_format($product->product_with_discount()) }} <span class="text-xs">تومان</span></p>
</div>
                        @endif

                        <a class="text-emerald-500 w-fit mx-auto font-bold border-b border-dashed border-black"
                           href="{{ route('product', $product) }}">
                            <span>خریـد</span>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
