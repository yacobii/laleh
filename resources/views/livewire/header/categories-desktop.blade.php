<?php

use Livewire\Volt\Component;

new class extends Component {

    #[\Livewire\Attributes\Computed]
    public function categories()
    {
        return \App\Models\Category::query()->with('children.products')
            ->whereNull('parent_id')
            ->latest()->get();
    }

}; ?>

<div class="divide-y bg-black text-white w-full">
    @foreach($this->categories as $category)
        <li wire:key="{{ $category->id }}" x-data="{open:false}" class="">
            <div @click="open = !open" class="p-3 flex items-center justify-between">
                <span>{{ $category->name }}</span>
                <span>
                <svg x-show="open === false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
</svg>
<svg x-show="open === true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
     stroke="currentColor"
     class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
</svg>
            </span>


            </div>

            <div x-show="open" @click.outside="open=false" x-cloak class="space-y-2 py-4">
                @foreach($category->children as $child)
                    <p wire:key="{{ $child->id }}" class="text-sm mr-3">
                        @if($child->products->count())
                            <a href="{{ route('category.products', $child) }}">{{ $child->name }}</a></p>
                    @endif
                @endforeach

            </div>


        </li>

    @endforeach

    <div class="py-4 px-2">
        <a class="" href="{{ route('products') }}">تمامی محصولات</a>
    </div>
</div>
