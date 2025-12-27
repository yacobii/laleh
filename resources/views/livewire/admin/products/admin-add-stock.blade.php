<?php

use Livewire\Volt\Component;

new class extends Component {


    public $andaze;
    public $amount;
    public function addStock()
    {
        $this->andaze->stocks()->updateOrCreate(['variation_id' => $this->andaze->id], ['amount' => $this->amount]);
        $this->dispatch('refresh');
        $this->reset('amount');
    }

}; ?>

<div>
    <div class="flex items-center">
        <label for="">
            <input type="text" wire:model="amount" class="w-16 h-7">
        </label>
        <button wire:click="addStock" class="focus:outline-none size-7 bg-green-500 text-white text-xl grid place-items-center">
            <x-heroicon-o-plus class="size-5" />
        </button>

    </div>
</div>
