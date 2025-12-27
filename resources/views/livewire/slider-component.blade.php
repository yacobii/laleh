<div class="w-full relative">
    @if(!is_null($product->discount_rate))
        <p class="absolute z-[20] top-3 right-0 flex gap-1 bg-red-500 rounded-l-2xl text-white text-sm p-2">
            <span>تخفیف</span>
            <span>{{ $product->discount_rate }}</span>
            <span>درصد</span>
        </p>
    @endif
    <div class="swiper product-swiper relative">


        <div class="swiper-wrapper">
            @foreach($this->images as $image)
                <div class="swiper-slide w-full z-0 object-cover" wire:key="{{ $image->id }}">
                    <img src="{{ $image->getUrl('main') }}" alt="">
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>

        <div class="next absolute top-1/2 transform -translate-y-1/2 left-0 z-10">
            <x-icons.arrow-left class="size-7 md:size-10 bg-gray-700 text-white p-2" />
        </div>
        <div class="prev absolute top-1/2 transform -translate-y-1/2 right-0 z-10">
            <x-icons.arrow-right class="size-7 md:size-10 bg-gray-700 text-white p-2" />
        </div>
    </div>
</div>
