<?php

use Livewire\Volt\Component;

new class extends Component {

    public \App\Models\Category $category;


    #[\Livewire\Attributes\Computed]
    public function products()
    {
        return \App\Models\Product::query()->whereIn('category_id', $this->category->children->pluck('id'))->take(8)->get();
    }


}; ?>

<div>
   <div class="grid grid-cols-2 md:grid-cols-8 gap-4">
       @foreach($this->products as $product)
           <div wire:key="{{$product->id}}">
               <img class="object-cover rounded-lg aspect-square w-full" src="{{ $product->getFirstMediaUrl('products', 'preview') }}" alt="">
           </div>
       @endforeach
   </div>
</div>
