<?php

use Livewire\Volt\Component;

new class extends Component {
    public \App\Models\Order $order;
}; ?>

<div>
    <div class="divide-y divide-dashed divide-black [&>div]:py-2 bg-gray-100 p-3">
        @foreach($order->items as $item)
            <div wire:key="{{ $item->id }}" class="py-1 md:py-2">
                <div class="flex flex-col md:flex-row md:items-center gap-3">
                    <img class="size-14 object-cover"
                         src="{{ $item->product->getFirstMediaUrl('products', 'preview') }}" alt="">
                    <p>{{ $item->product->title }}</p>
                    <p>{{ $item->qty }} <span class="text-xs">عدد</span></p>
                    <p>{{ $item->size }}</p>
                    <p>{{ number_format($item->product->price) }} <span class="text-xs">ریال</span></p>
                    <p class="text-xs"><span>فی:</span> {{ number_format($item->total) }}
                        <span>ریال</span></p>

                </div>

            </div>
        @endforeach
    </div>
</div>
