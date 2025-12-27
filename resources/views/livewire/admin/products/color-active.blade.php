<?php

use Livewire\Volt\Component;

new class extends Component {

    public  $color;

    protected $rules = ['color.active' => 'boolean'];



    public function save() {
        $val = $this->validateOnly('color.active');

        $this->color->save($val);
    }
}; ?>

<div class="">
    <label for="">
        <input type="checkbox" wire:click="save" wire:model="color.active">
    </label>
</div>
