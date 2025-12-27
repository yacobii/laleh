<div class="py-4">
    <div class="flex flex-col md:flex-row items-start gap-3 ">
        <div class="relative">
            <img class="w-32 object-cover md:w-40 border rounded-lg"
                 src="{{ $item->variation->parent->getFirstMediaUrl('colors', 'preview') }}"
                 alt="">
            @if($item->variation->product->discounted)
                <div class="absolute  left-1 top-1 p-1 z-10">
                    <p class="text-xs size-5 text-white rounded-lg p-1 bg-red-500">
                        %{{ $item->variation->product->rate }}</p>
                </div>
            @endif
        </div>
        <div class="space-y-1">
            <p class="font-bold text-right">{{ $item->variation->product->name }}</p>
            <div class="flex items-center gap-5">
                <p class="flex items-center gap-x-2">
                    <span>رنگ:</span><span>{{ $item->variation->parent->title }}</span></p>
                <p class="flex items-center gap-x-2">
                    <span>سایز:</span><span>{{ $item->variation->title }}</span></p>

            </div>
            <p class="flex items-center gap-x-2">
                <span>تعداد:</span><span>{{ $item->qty }}</span></p>
            <div>
                <div class="flex items-center gap-1">
                    <div class="flex items-center gap-1">
                        <p>قیمت</p>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-1">
                                <p class="{{ $item->variation->product->discounted ? 'line-through' : '' }}">{{ number_format($item->variation->product->price) }}</p>
                                @if($item->variation->product->discounted)
                                    <p class="">{{ number_format($item->variation->product->product_with_discount()) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                        @if($item->qty > 1)
                            <div class="flex items-center gap-1">
                                <span>|</span>
                                <div class="flex items-center gap-1">
                                    <p>جمع</p>
                                    <p>{{ number_format($item->variation->product->product_price() * $item->qty) }}</p>
                                    <p>تومان</p>
                                </div>
                            </div>
                        @endif


                </div>
                @if($item->variation->product->discounted)
                    <p class="text-red-500 text-sm">مشمول کد تخفیف نمیشود.</p>
                @endif
            </div>


            <div class="flex items-center gap-2">
                @if($item->order->coupon && !$item->variation->product->discounted)
                    <p>تخفیف</p>
                    <p>{{ number_format($item->discount() ) }}</p>
                    <p>تومان</p>
                @endif
            </div>
        </div>
    </div>
</div>
