<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {

public \App\Models\Category $category;


    #[Computed]
    public function products()
    {
        $childIds = $this->category->children()->pluck('id');
        return \App\Models\Product::query()->whereIn('category_id', $childIds)->get();
    }

}; ?>

<div class="py-10">
    <div class="w-full grid grid-cols-1 md:grid-cols-5 gap-x-5  gap-y-10 mx-auto">
        @forelse($this->products as $product)
            <div class="relative w-full" wire:key="product-{{ $product->id }}">
                <img class="w-full object-cover"
                     src="{{ $product->getFirstMediaUrl('products', 'cover') }}"
                     title="{{ $product->title }}"
                     alt="{{ $product->title }}">
                <div class="flex flex-col justify-between">
                    <div class="mt-3 text-center grid gap-3">
                        <a class="text-emerald-500 font-bold border-b border-dashed w-fit mx-auto border-black"
                           href="{{ route('product', $product) }}">
                            <span>خریـد</span>
                        </a>
                        <p class="text-sm">{{ number_format($product->price) }} <span
                                class="text-xs">تومان</span></p>
                        <p class="text-center mt-2 text-sm">{{ $product->category->title }}</p>
                    </div>
                    <p class="text-center mt-2 font-bold  text-sm">{{ $product->title }}</p>
                </div>

            </div>

        @empty
            <div>
                <p>محصولی موجود نیست</p>
            </div>
        @endforelse
    </div>
</div>
