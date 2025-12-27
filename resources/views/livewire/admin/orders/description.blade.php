<?php

use Livewire\Volt\Component;

new class extends Component {
    public $order;

    public function rules()
    {
        return [
          'order.description' => 'string'
        ];
    }


    public function updated($prop)
    {
        $val = $this->validateOnly($prop);
        $this->order->save($val);
    }

}; ?>

<div class="p-4">
    <textarea wire:model.live.debounce="order.description" class="w-full min-h-24" placeholder="توضیحات"></textarea>
</div>
