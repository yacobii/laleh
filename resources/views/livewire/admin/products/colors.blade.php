<div class="relative">

    <livewire:admin.product.edit-header :product="$product"/>

    <div class="p-3 md:p-10 grid grid-cols-3 md:grid-cols-8 gap-3">
        @foreach($this->colors as $color)
            <div wire:key="{{ $color->id }}">
                <button
                    @class([
    'outline-none py-2 px-4 rounded-lg bg-gray-200',
    'bg-green-500 text-white' => $product->colors->contains($color->id)
])
                    wire:click="toggle({{$color->id}})" >{{ $color->title }}</button>
            </div>
        @endforeach
    </div>
</div>
