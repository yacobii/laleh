<?php

use Livewire\Volt\Component;

new class extends Component {

    #[\Livewire\Attributes\Computed]
    public function orders()
    {
        return auth()->user()->orders;
    }

    public function dilit(\App\Models\Order $order)
    {
        $order->delete();
    }

}; ?>

<div>
    <div class="bg-white profile-card rounded-xl p-6 mb-4">
        @if(count($this->orders))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($this->orders as $order)
                    <div wire:key="{{ $order->id }}" class=" border relative h-full flex flex-col space-y-2">
                        <div class="space-y-1 p-2">
                            <p>{{ $order->code }}</p>
                            <p>{{ number_format($order->total_with_coupon) }}</p>
                            <p>{{ verta($order->created_at)->format('Y/m/d') }}</p>
                        </div>
                        <ul class="list-disc list-inside flex-1 bg-gray-200 p-3">
                            @foreach($order->items as $item)
                                <li>{{ $item->product->title }}</li>
                            @endforeach
                        </ul>
                        <div class="flex justify-between p-2">
                            <p>{{ $order->status->label() }}</p>
                            @if($order->status != \App\StatusEnum::COMPLETED)
                                <button wire:confirm="" class="outline-none text-red-500 text-sm"
                                        wire:click="dilit({{$order->id}})">x
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
