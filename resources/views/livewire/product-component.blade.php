<div>
    <x-slot name="seo">
        <title>{{ $product->title }}</title>
        <meta name="description" content="{{ $product->body }}"/>
        <link rel="canonical" href="{{ route('product', $product) }}"/>
    </x-slot>
    <div class="size pt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative">
            <livewire:slider-component :product="$product"/>

            <div class="relative px-5 md:px-0">

                <div class="">
                    @auth
<div class="mb-6">
    <button class="flex w-full items-center gap-x-2 outline-none" wire:click="fav">
        <x-icons.fav @class([
    'size-7 fill-neutral-300',
    'size-7 fill-red-500' => count($product->favorites)
]) />
    </button>
</div>
                    @endauth
                    <p class="font-bold text-lg text-right">{{ $product->title }}</p>
                    <div class="flex flex-col relative">
                        <div
                            class="markdown text-justify text-gray-700">{{ \Illuminate\Mail\Markdown::parse($product->body) }}</div>
                    </div>

                </div>
                @if($product->active)
                    <div class="flex items-center justify-start gap-3 my-10">
                        <p>قیمت:</p>
                        @if(is_null($product->discount_rate))
                            <p>
                                <span>{{ number_format($product->price) }}</span>
                            </p>
                            @else
                            <div class="">
                                <p class="flex items-center gap-2">
                                    <span class="line-through">{{ number_format($product->price) }}</span>
                                    <span class="font-bold">{{ number_format($product->product_with_discount()) }}</span>
                                </p>
                            </div>
                        @endif

                        <p>تومان</p>
                    </div>
                @else
                    <div class="pc-no"><p>ناموجود</p></div>

                @endif

                @if(! $this->productInCart)

                    <div class="my-8 space-y-4">
                        <div class="border-b pb-2 text-right">
                            <p>انتخاب رنگ</p>
                        </div>
                        <div class="w-full flex  flex-wrap justify-start gap-4">
                            @foreach($this->colors as $color)
                                <div class="" wire:key="{{ $color->id }}">
                                    <button
                                        @class([
                'border w-full rounded-lg border-gray-400 py-1 px-2',
                'bg-green-500 text-white border-none' => $color->id === $selected_color,
            ])
                                        wire:click="set('selected_color', {{ $color->id }})">
                                        <span class="">{{ $color->title }}</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="my-8 space-y-4">
                        <div class="border-b pb-2 text-right">
                            <p>انتخاب سایز</p>
                        </div>
                        <div class="w-full flex  flex-wrap justify-start gap-4">
                            @foreach($this->sizes as $size)
                                <div class="" wire:key="{{ $size->id }}">
                                    <button
                                        @class([
                'border w-full rounded-lg border-gray-400 py-1 px-2',
                'bg-green-500 text-white border-none' => $size->id === $selected_size
            ])
                                        class=""
                                        wire:click="set('selected_size', {{ $size->id }})">
                                        <span>{{ $size->title }}</span>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                @endif

                <div class="grid gap-5">
                    <div class="">

                        @if(!$this->productInCart)
                            <button class="flex w-full items-center gap-x-2 outline-none" wire:click="add">
                                <span class="bg-emerald-500 rounded-xl text-white py-1 px-4">افزودن به سبد خرید</span>
                            </button>

                        @else
                            <div class="flex items-center justify-between">
                                <div class="flex gap-2">
                                    <x-icons.cart class="size-5 text-emerald-500" />
                                    <a href="{{ route('cart') }}" class="text-green-500 grid place-items-center">
                                        <span>مشاهده سبد خرید</span>
                                    </a>
{{--                                    @if($this->productInCart)--}}
{{--                                        <button class="text-red-400" wire:click="remove">--}}
{{--                                            <x-icons.trash class="size-4"/>--}}
{{--                                        </button>--}}
{{--                                    @endif--}}
                                </div>


                                <div class="">
                                    <a href="{{ route('products') }}"
                                       class="flex items-center gap-4">
                                        <span>ادامه خرید</span>
                                        <span><x-icons.arrow-left class="size-4"/></span>
                                    </a>
                                </div>
                            </div>
                        @endif


                    </div>


                </div>

                <div class="my-3">
                    <x-errors/>
                </div>

            </div>
        </div>
    </div>

    @can('super')
        <a href="{{ route('admin.product.edit', $product) }}" target="_blank" class="fixed top-20 right-2">edit</a>
        @endcan
</div>
