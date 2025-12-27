<div class="size pt-20">
    <div class="flex flex-col md:flex-row items-start gap-x-8">
        <!-- Filter Desktop -->
        <div class="hidden md:block border rounded-lg  shrink-0 w-40">
            <p class="font-bold bg-gray-200 p-4 w-full">فیلتر</p>
            <div class="grid gap-8 p-4">
                @foreach($this->categories as $category)
                    <div wire:key="category-{{ $category->id }}">
                        <button wire:click.debounce="filterByCategory({{$category->id}})"
                                class="font-bold outline-none {{ $category->id === $idd ? 'text-red-400' : '' }}">{{ $category->title }}</button>
                        <div class="mt-1">
                            @foreach($category->children as $child)
                                <div class="text-sm" wire:key="child-{{ $child->id }}">
                                    <button wire:click.debounce="filterByCategory({{$child->id}})"
                                            class="outline-none {{ $child->id === $idd ? 'text-red-400' : '' }}">
                                        - {{ $child->title }}</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Filter Mobile -->
        <div x-data="{filter:false}" class="md:hidden">
            <button @click="filter = true" class="outline-none font-bold bg-gray-200 px-4 py-1 w-full">فیلتر
            </button>
            <div x-show="filter"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-x-full"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-full"
                 x-cloak class="fixed inset-y-0 h-screen left-0 w-1/2 bg-neutral-800 text-white z-50">
                <div class="grid gap-8 p-4" @click.outside="filter = false">
                    @foreach($this->categories as $category)
                        <div wire:key="category-{{ $category->id }}">
                            <button wire:click.debounce="filterByCategory({{$category->id}})"
                                    class="font-bold outline-none {{ $category->id === $idd ? 'text-red-400' : '' }}">{{ $category->title }}</button>
                            <div class="mt-1">
                                @foreach($category->children as $child)
                                    <div class="text-sm" wire:key="child-{{ $child->id }}">
                                        <button wire:click.debounce="filterByCategory({{$child->id}})"
                                                class="outline-none {{ $child->id === $idd ? 'text-red-400' : '' }}">
                                            - {{ $child->title }}</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="w-full grid grid-cols-2 md:grid-cols-5 gap-x-5  gap-y-10 mx-auto">
            @forelse($this->products as $product)
                <div class="relative w-full" wire:key="product-{{ $product->id }}">
                    <div class="relative">
                        <img class="w-full object-cover"
                             src="{{ $product->getFirstMediaUrl('products', 'cover') }}"
                             title="{{ $product->title }}"
                             alt="{{ $product->title }}">
                        @if(!is_null($product->discount_rate))
                            <p class="absolute top-3 right-0 flex gap-1 bg-red-500 rounded-l-2xl text-white text-sm py-1 px-2">
                                <span>تخفیف</span>
                                <span>{{ $product->discount_rate }}</span>
                                <span>درصد</span>
                            </p>
                        @endif
                    </div>

                    <div class="flex flex-col justify-between">
                        <div class="mt-3 text-center grid gap-3">
                            <a class="text-emerald-500 font-bold border-b border-dashed w-fit mx-auto border-black"
                               href="{{ route('product', $product) }}">
                                <span>خریـد</span>
                            </a>
                            @if(is_null( $product->discount_rate))
                                <p class="text-sm">{{ number_format($product->price) }} <span class="text-xs">تومان</span></p>
                            @else
                                <div>
                                    <p class="text-sm line-through">{{ number_format($product->price) }} <span class="text-xs">تومان</span></p>
                                    <p class="text-sm">{{ number_format($product->product_with_discount()) }} <span class="text-xs">تومان</span></p>
                                </div>
                            @endif
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
    @if($this->products->hasMorePages())
        <div x-data x-intersect="$wire.loadMore">
        </div>
    @endif
</div>
