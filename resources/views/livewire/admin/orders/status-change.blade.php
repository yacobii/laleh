<?php

use Livewire\Volt\Component;

new class extends Component {

    public \App\Models\Order $order;

    public function changeStatus($value)
    {
        $this->order->status = $value;
        $this->order->saveQuietly();
        $this->js('$wire.$parent.$refresh()');
    }


}; ?>

<div class="p-2">
    <div class="flex gap-4 text-sm">
        <button
            class="outline-none rounded-lg py-1 px-2 {{ $order->status->value === 'new' ? 'bg-red-500  text-white' : '' }}"
            wire:click="changeStatus('new')">جدید</button>
        <button
            class="outline-none rounded-lg py-1 px-2 {{ $order->status->value === 'cancel' ? 'bg-gray-500 text-white'  : '' }}"
            wire:click="changeStatus('cancel')">کنسل
        </button>
        <button
            class="outline-none rounded-lg py-1 px-2 {{ $order->status->value === 'completed' ? 'bg-green-500  text-white' : '' }}"
            wire:click="changeStatus('completed')">تکمیل
        </button>
    </div>
</div>
