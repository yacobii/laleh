<div class="p-5">
    <div class="mb-4 flex ">
        <input type="search" wire:model.debounce.500ms="term" placeholder="جستجو..." class="w-full h-10">
        <button wire:click="search" class="bg-black px-6 text-white h-10 outline-none">جستجو</button>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @foreach($this->prods as $product)
            <div wire:key="{{ $product['id'] }}" class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex items-center space-x-4 mb-3">
                    @if ($product['thumbnail'])
                        <img class="w-16 h-16 object-cover rounded" src="{{ $product['thumbnail'] }}" alt="{{ $product['title'] }}">
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center">
                            <x-icons.image class="size-8 text-gray-400" />
                        </div>
                    @endif
                    <div>
                        <a href="{{ route('admin.snappshopp.edit', $product['id']) }}"><h3 class="font-medium">{{ $product['title'] }}</h3></a>
                        <div class="text-green-600">{{ number_format($product['price']) }} تومان</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    @if($hasMore)
        <div x-data x-intersect="$wire.loadMore" class="py-8 text-center">
        </div>
    @endif

</div>
