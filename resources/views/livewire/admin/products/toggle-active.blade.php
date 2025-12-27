<?php

use Livewire\Volt\Component;

new class extends Component {
    public \App\Models\Product $product;

    public function toggle()
    {
        $this->product->active = !$this->product->active;
        $this->product->saveQuietly();
        $this->js('$wire.$parent.$refresh()');
    }
}; ?>

<div>

        <button class="outline-none" wire:click="toggle">{{ $product->active ? 'ACTIVE' : 'DISABLED' }}</button>

</div>
