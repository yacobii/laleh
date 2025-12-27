<?php

use Livewire\Volt\Component;

new class extends Component {
    #[\Livewire\Attributes\Computed]
    public function categories()
    {
        return \App\Models\Category::query()->isRoot()->get();
    }

}; ?>

<div class="size pt-20">
    <div class="grid gap-x-8 mx-auto divide-y divide-dashed">
        @foreach($this->categories as $category)
            <div wire:key="{{ $category->id }}" class=" py-8">
                <div class="flex items-center justify-between">
                    <p>{{ $category->title }}</p>
                    <a href="{{ route('category.products', $category) }}" class="flex items-center gap-3">
                        <span>مشاهده همه محصولات</span>
                        <x-icons.chevron-left class="size-4"/>
                    </a>
                </div>
                <div class="mt-4">
                    <livewire:home.category-products :category="$category" :key="$category->id"/>
                </div>
            </div>
        @endforeach
    </div>
</div>
