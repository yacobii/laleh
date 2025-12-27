<div class="size pt-20">
    <div class="px-3">
        <p class="font-bold my-2">وضعیت سفارش شما</p>
        <div class="space-y-1">
            <p class="flex items-center gap-2"><span>شماره سفارش:</span><span>{{ $order->code }}</span></p>
            <p class="flex items-center gap-2"><span>سفارش دهنده:</span><span>{{ $order->user->name }}</span></p>
            <p class="flex items-center gap-2"><span>موبایل:</span><span>{{ $order->user->mobile }}</span></p>
            <p class="flex items-center gap-2"><span>تلفن:</span><span>{{ $order->user->tel ?? 'ثبت نشده' }}</span></p>
            <p class="flex items-center gap-2"><span>کدپستی:</span><span>{{ $order->user->postal }}</span></p>
            <p class="grid gap-2"><span>آدرس پستی:</span><span>{{ $order->user->address }}</span></p>

            <livewire:modal :user="$order->user"/>

        </div>

        <div class="my-5">
            <p class="font-bold ">آیتمهای سفارش:</p>
            <div class="w-fit divide-y divide-dashed divide-gray-500">
                @foreach($order->items as $item)
                    <div wire:key="{{ $item->id }}" class="py-4 space-y-2">
                        <div>
                            <img class="w-32 border-2"
                                 src="{{ $item->Product->getFirstMediaUrl('products','preview') }}"
                                 alt="">
                        </div>
            <div class="flex items-center gap-1">
                <p> {{ $item->product->title }}</p>
                <p class="flex items-center gap-1"> {{ $item->qty }} <span>عدد</span></p>
            </div>
                        <p class="flex text-sm items-center gap-1"> {{ number_format($item->product->price) }}<span class="text-xs">تومان</span>
                        </p>
                        <div class="border-y py-2 space-y-1">
                            @if($order->coupon)
                                <p><span>کوپن تخفیف:</span> {{ $order->coupon->title ?? null }}</p>
                                <p><span>درصد تخفیف:</span> {{ $order->coupon->percentage ?? null }}</p>
                            @endif


                            <div class="flex gap-2 items-center">
                                <span>جمع کل:</span>
                                <div class="flex items-center gap-1 font-bold">
                                    <p class="{{ $order->coupon ? 'line-through text-sm' : '' }}">{{ number_format($order->total) }}</p>
                                    @if($order->coupon)
                                        <p>{{ number_format($order->total_with_coupon) }}</p>
                                    @endif
                                </div>
                                <span>تومان</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($order->status === 'new')
            <button
                class="outline-none text-red-500 flex items-start gap-2 text-sm"
                wire:confirm="سفارش حذف شود؟ غیرقابل بازگشت است !" wire:click="dilitOrder">
                <span><x-icons.trash class="size-4"/></span>
                <span>حذف سفارش</span>
            </button>
        @endif

        {{--    <div class="my-5 ">--}}
        {{--        <a href="{{ route('cart') }}" class="flex items-center gap-2 text-gray-400">--}}
        {{--            <span>مشاهده سبد خرید</span>--}}
        {{--            <span><x-icons.chevron-left class="size-4" /></span>--}}
        {{--        </a>--}}
        {{--    </div>--}}
    </div>

    <div class="p-5 text-white bg-emerald-700 rounded-t-2xl">
        <p>با تشکر از خرید، سفارش شما در حال پیگیری و ارسال است (این متن دمو و نمایشی است).</p>
    </div>
</div>
