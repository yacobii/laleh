<div class="size bg-primary-content/20     ">
    <div class="flex flex-col md:flex-row items-start gap-x-8">
        <!-- Filter Desktop -->
        <div class="hidden md:grid gap-5">
            <div class="border rounded-lg  shrink-0">
                <p class="font-bold bg-gray-200 p-4">فیلتر</p>
                <div class="grid gap-3 p-4">
                    @foreach($this->children as $child)
                        <div class="" wire:key="{{ $child->id }}">
                            <button class="outline-none"
                                    wire:click="set('category_id', '{{$child->id}}')">{{ $child->title }}</button>
                        </div>
                    @endforeach
                    <div class="grid gap-4">
                        <button wire:click="set('option', 'lowest')">ارزانترین</button>
                        <button wire:click="set('option', 'highest')">گرانترین</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Mobile -->
        <div x-data="{filter:false}" class="md:hidden">
            <div class="">
                <button @click="filter = true" class="outline-none font-bold bg-gray-200 px-4 py-1 w-full">فیلتر</button>
                <div x-show="filter" x-cloak
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 -translate-x-full"
                     x-transition:enter-end="opacity-100 translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="opacity-100 translate-x-0"
                     x-transition:leave-end="opacity-0 -translate-x-full"
                     class="fixed inset-y-0 h-screen left-0 w-1/2 bg-neutral-800 text-white z-50"
                >
                    <div class="flex flex-col gap-5 p-5" @click.outside="filter = false">
                        @foreach($this->children as $child)
                            <div class="" wire:key="{{ $child->id }}">
                                <button class="outline-none" wire:click="set('category_id', '{{$child->id}}')">{{ $child->title }}</button>
                            </div>
                        @endforeach
                        <div class="flex flex-col justify-start items-start gap-5">
                            <button wire:click="set('option', 'lowest')">ارزانترین</button>
                            <button wire:click="set('option', 'highest')">گرانترین</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full grid grid-cols-2 md:grid-cols-4 gap-x-8 space-y-12">
            @foreach($this->products as $product)
                <div wire:key="{{ $product->id }}" class="text-sm text-center">
                    <div class="group relative">
                        <img
                            class="w-full object-cover transition-opacity duration-300 ease-in-out group-hover:opacity-0"
                            src="{{ $product->getFirstMediaUrl('products', 'cover') }}"
                            alt="{{ $product->title }}">
                        <img
                            class="w-full object-cover absolute top-0 left-0 opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
                            src="{{ $product->getMedia('products')?->get(1)?->getUrl('main') ?? asset('fallback/fallback-slider.jpg') }}"
                            alt="{{ $product->title }}">
                    </div>
                    <div class="mt-4 space-y-4 ">
                        <div>
                            <p class="text-gray-400 ">{{ $product->category->title }}</p>
                            <h2 class="font-bold h-8">{{ $product->title }}</h2>
                        </div>
                        <p class="">{{ number_format($product->price ?? '0') }} <span class="text-xs">تومان</span>
                        </p>
                        <a class=" mt-8 border-b border-dashed border-black pb-2 w-fit text-emerald-500 font-bold"
                           href="{{ route('product', $product) }}">
                            <span>خرید</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
