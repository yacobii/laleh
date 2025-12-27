<?php

use Livewire\Volt\Component;

new class extends Component {

    public $variation;

    protected $rules = ['variation.sku' => 'string'];

    public function updatedVariation()
    {
        $this->variation->save();
    }

}; ?>

<div>
    <input type="text" class="font-sans ltr w-full h-8" wire:model.live="variation.sku" placeholder="sku">
</div>
