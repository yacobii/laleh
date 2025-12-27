<x-layouts.app>
    <div class="flex flex-col size">
        <div class="mt-14 grow">

            <div class="">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-20 mt-5 mx-auto">
                    @foreach($products as $product)
                        <div class="relative w-full" wire:key="{{ $product->id }}">
                            <a href="{{ route('product', $product) }}">
                                <img class="w-full object-cover"
                                     src="{{ $product->variations->where('type', 'color')->where('selected', true)->first()->getFirstMediaUrl('colors', 'slider') }}"
                                     title="{{ $product->name }}"
                                     alt="{{ $product->name }}">
                                <div class="py-3 space-y-2">
                                    <p class="text-right mt-2 font-bold h-14">{!! nl2br($product->name) !!}</p>
                                    <div class="text-gray-400 markdown text-sm h-32">
                                        {{ \Illuminate\Mail\Markdown::parse(str()->words($product->description, 15)) }}
                                    </div>

                                    @if($product->active)
                                        <div class="flex items-center justify-between md:gap-x-5">
                                            <p class="text-sm">
                                                <span @class(['line-through' => $product->discounted])>{{ number_format($product->price) }}  <span class="text-xs">تومان</span></span>

                                            </p>
                                            @if($product->discounted)
                                                <p class="text-sm">
                                                    <span>{{ number_format($product->price - ($product->price * $product->rate) / 100) }}</span>
                                                    <span class="text-xs">تومان</span>
                                                </p>
                                            @endif
                                        </div>
                                    @else
                                        <p>ناموجود</p>
                                    @endif
                                </div>

                                <livewire:product-variation-color :product="$product"/>
                            </a>

                            @if($product->discounted)
                                <div class="absolute left-0 top-0 p-2">
                                    <p class="text-ms text-white rounded-lg py-1 px-4 bg-red-500">
                                        %{{ $product->rate }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
