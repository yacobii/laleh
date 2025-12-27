<div class="w-full my-5">
    <div class="border border-black ">
        <div class="flex flex-col justify-between">
            <div class="flex items-center justify-between  bg-gray-800 text-white p-2">
                <p> کدسفارش: {{ $order->code }}</p>
                <p class="text-sm">{{ verta($order->created_at)->format('l d F Y - H:i:s') }}</p>
                @if($order->payment_status == 0)
                    <button class="bg-red-500 focus:outline-none text-white w-3"
                            wire:confirm wire:click="dilitOrder">x
                    </button>
                @endif
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-300">
                <p>{{ $order->user->name }} - {{ $order->id }}</p>
                <div x-data="{ msg:'' }">
                    <button type="button"
                            @click="$clipboard('{{ $order->user->mobile }}'); msg = 'Copied'">
                        {{ $order->user->mobile }} <span class="text-green-500" x-text="msg"></span>
                    </button>
                </div>
            </div>
            <div class="p-2">
                <p>کدپستی: {{ $order->user->postal }}</p>
                <p> شهر: {{ $order->user->city ?? '-' }}</p>
                <p> آدرس: {{ $order->user->address }}</p>
                <p> کدملی: {{ $order->user->melli }}</p>
            </div>
            <!-- flex - 1 -->
            <div class="flex-1 h-full grow">
                <div class=" p-2 divide-y flex-1 divide-dashed divide-black border-y border-black">
                    @foreach($order->items as $item)
                        <div class="py-2" wire:key="{{ $item->id }}">
                            <p class="font-bold p-2">  {{ $item->variation->product->name }}</p>
                            <div class="w-full flex items-start gap-5 ">

                                <div class="relative">
                                    <img class="w-28"
                                         src="{{ $item->variation?->parent->getFirstMediaUrl('colors', 'preview') }}"
                                         alt="">
                                    <p @class([
        'absolute left-0 top-0',
        'bg-red-500 p-1 text-white text-sm' => $item->has_discount
])>
                                        @if($item->has_discount)
                                            %{{ $item->variation->product->rate }}
                                        @endif
                                    </p>
                                </div>
                                <div class="w-full space-y-1 text-sm">
                                    <div class="flex items-center justify-between text-sm">
                                        <div class="flex items-center gap-5">
                                            <span>تعداد:</span>
                                            <div class="flex items-center gap-3">
                                                @if($order->paymented === 'اسنپ')
                                                    <div class="flex items-center justify-center gap-5">
                                                        <button
                                                            wire:confirm="از حذف این آیتم مطمئن هستید؟ غیرقابل برگشت است."
                                                            wire:click="delitiItem('{{$item->id}}')">
                                                            <x-heroicon-c-trash class="size-4 text-red-500"/>
                                                        </button>
                                                        <button
                                                            class="outline-none"
                                                            wire:confirm="خطر!!! به سفارش اسنپ اضافه میشود! هرگز قابل بازگشت نیست. مطمئن هستید؟"
                                                            wire:click="addQTY({{ $item }}, {{ $item->qty }})">
                                                            <x-heroicon-c-plus class="text-red-500 size-4"/>
                                                        </button>
                                                    </div>

                                                @endif
                                                {{ $item->qty }}
                                                @if($order->paymented === 'اسنپ')
                                                    <button
                                                        class="outline-none"
                                                        wire:confirm="خطر!!! تعداد از سفارش اسنپ کم میشود! هرگز قابل بازگشت نیست. مطمئن هستید؟"
                                                        wire:click="subtractQTY({{ $item }}, {{ $item->qty }})">
                                                        <x-heroicon-c-minus class="text-red-500 size-4"/>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <p>
                                            <spa>سایز:</spa> {{ $item->variation->title }}</p>

                                    </div>
                                    <p class="text-sm"><span>رنگ:</span> {{ $item->variation->parent->title }}</p>

                                    <div>
                                        @if($item->has_discount)
                                            <p>مشمول کد تخفیف نمیشود</p>
                                        @endif
                                        @if($order->coupon)
                                            <p>{{ $order->coupon->title ?? null }} -
                                                %{{ $order->coupon->percentage ?? null }}</p>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-2 ">
                                        <span>قیمت</span>
                                        @if($item->has_discount)
                                            <div class="flex  items-center gap-2">
                                                <div class="flex items-center gap-2">
                                                    <p class="line-through">  {{ number_format($item->variation->product->price) }} </p>
                                                    <p>  {{ number_format($item->price) }} </p>
                                                </div>
                                                <span>|</span>
                                                <div class="flex items-center gap-2">
                                                    <p>جمع:</p>
                                                    <p class="font-bold">{{ number_format($item->total()) }}</p>
                                                    <span>تومان</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex  items-center gap-2">
                                                <div class="flex items-center gap-2">
                                                    <p>  {{ number_format($item->price) }} </p>
                                                </div>
                                                <span>|</span>
                                                <div class="flex items-center gap-2">
                                                    <p>جمع:</p>
                                                    <p class="font-bold">{{ number_format($item->price * $item->qty) }}</p>
                                                    <span>تومان</span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>

                                    @if($order->coupon)
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center gap-2">
                                                <p>تخفیف</p>
                                                <p class="font-bold">{{ number_format($order->coupon->percentage) }}</p>
                                            </div>
                                            <span>|</span>
                                            <div class="flex items-center gap-2">
                                                <p> جمع با تخفیف</p>
                                                <p class="font-bold">{{ number_format($order->total_with_coupon) }}</p>
                                                <span>تومان</span>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>


                        {{--                <livewire:admin.orders.single-item :$item  :key="'item-'.$item->id" />--}}
                    @endforeach

                    <div class="py-3">
                        <p>{{ $order->comment ?? 'توضیحات ندارد' }}</p>
                        @if($order->coupon)
                            <p>کوپن: {{ $order->coupon->title }}</p>
                        @endif

                        <p><span>شیوه پرداخت:</span> {{ $order->paymented }}
                            - {{ $order->payment_status? 'موفق' : 'ناموفق' }}</p>
                        <p><span>نحوه ارسال:</span> {{ $order->ersal }}</p>
                        @unless($order->ersal === 'تیپاکس')
                            <p><span>روز:</span> {{ $order->day }}</p>
                            <p><span>ساعت:</span> {{ $order->zaman }}</p>
                        @endif
                    </div>
                </div>

                <div class="p-3">
                    <p class="text-red-500">{{ $this->show_stock }}</p>
                    @if($order->dargah)
                        <div>
                            <p>{{ $order->dargah->rrn }}</p>
                        </div>
                    @endif
                    <p>{{ $order->paymented }}</p>
                    <div>
                        @if($order->paymented === 'اسنپ')
                            <div>
                                <div class="flex items-center gap-4 my-4 justify-center">
                                    <button wire:confirm="قابل برگشت نیست. مطمئن هستید؟" wire:click="cancelSnapp">کنسل
                                        سفارش اسنپ
                                    </button>
                                    {{--                                                                    <button wire:confirm="قابل برگشت نیست. مطمئن هستید؟" wire:click="updateSnapp">--}}
                                    {{--                                                                        آپدیت سفارش--}}
                                    {{--                                                                    </button>--}}
                                </div>
                                <div>
                                    <p>{{ $order->orderToken?->payment_token }}</p>
                                    <p>{{ $order->transactionId }}</p>
                                </div>
                            </div>
                        @endif
                    </div>


                    @if($order->paymented === 'کارت')
                        <div class=" flex items-center gap-5">
                            <button wire:click="taeed" class="text-sm text-emerald-500">
                                <span>تایید سفارش</span>
                            </button>

                            @if($order->payment_status === true)
                                <button class="outline-none text-red-500" wire:click="notaeed">x</button>
                            @endif
                        </div>

                    @endif
                </div>

                <div>
                    <div class="bg-gray-800  text-gray-200 flex items-center justify-between p-3">
                        <p
                            @class([
                                'text-xl',
                                'text-red-500' => $order->status == 'جدید',
                                'text-emerald-400' => $order->status == 'ارسال',
                                'text-white' => $order->status == 'تکمیل',
                        ])
                            class="">{{ $order->status }}</p>
                        <div class="flex items-center gap-x-4">
                            <button wire:click.prevent="changeStatus('ارسال')"
                                    class="focus:outline-none text-sm py-1 px-3 rounded-lg bg-gray-500">ارسال
                            </button>
                            <button wire:click.prevent="changeStatus('تکمیل')"
                                    class="focus:outline-none text-sm py-1 px-3 rounded-lg bg-gray-500">تکمیل
                            </button>
                            <button wire:click.prevent="changeStatus('جدید')"
                                    class="focus:outline-none text-sm py-1 px-3 rounded-lg bg-gray-500">x
                            </button>
                            <button wire:click.prevent="changeStatus('کنسل')"
                                    class="focus:outline-none text-sm py-1 px-3 rounded-lg bg-gray-500">کنسل
                            </button>
                        </div>
                    </div>
                    <div class="bg-gray-500 text-white grid place-items-center p-3">
                        <p class="text-xl"> {{ number_format($order->sum() ) }}
                            <span>تومان</span></p>
                    </div>
                </div>

            </div>
        </div>

        <div>
        <livewire:admin.orders.description :$order />
        </div>

        {{--        <div class="text-left grid place-items-end">--}}
        {{--            @if($order->paymented === 'اسنپ')--}}
        {{--                <a href="{{ route('admin.orders.snapp') .'#'.$order->id }}" class="p-4">--}}
        {{--                    <x-heroicon-o-arrow-left class="size-6"/>--}}

        {{--                </a>--}}
        {{--            @endif--}}
        {{--        </div>--}}
    </div>
    <x-admin.order-sub/>
</div>
