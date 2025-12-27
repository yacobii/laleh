<div class="size space-y-6 mt-20">
    <div class="divide-y">
        @forelse($this->products as $product)
            <div class="py-4 " wire:key="{{ $product->id }}">
                <a href="{{ route('product', $product) }}" class="space-y-2">
                    <div>
                        <img class="w-full md:w-32 object-cover"
                              src="{{ $product->variations()->first()->getFirstMediaUrl('colors', 'small') }}"
                              title="{{ $product->name }}"
                              alt="{{ $product->name }}">
                    </div>
                    <p class="font-bold">{{ $product->name }}</p>
                    <p class="text-gray-400  text-sm">{{ \Illuminate\Mail\Markdown::parse($product->description) }}</p>
                </a>
            </div>

        @empty
            <p>شما هیچ محصولی را به علاقه مندی ها اضافه نکرده اید.</p>
        @endforelse
    </div>
</div>
