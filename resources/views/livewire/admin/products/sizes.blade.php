<div class="relative">

    <livewire:admin.product.edit-header :product="$product"/>

    <div class="p-3 md:p-10 grid grid-cols-3 md:grid-cols-8 gap-3">
        @foreach($this->sizes as $size)
            <div wire:key="{{ $size->id }}">
                <button
                    @class([
    'outline-none py-2 px-4 rounded-lg bg-gray-200',
    'bg-green-500 text-white' => $product->sizes->contains($size->id)
])
                    wire:click="toggle({{$size->id}})" >{{ $size->title }}</button>
            </div>
        @endforeach
    </div>
</div>
