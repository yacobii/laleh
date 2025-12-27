<?php

use  Livewire\Volt\Component;

new  class extends  Component {


    public \App\Models\Variation $andaze;

    protected $rules = ['andaze.active' => ''];

    public function mount()
    {
        $this->andaze->outOfStock() ? $this->andaze->active = false : '';
    }

    public function updated() {

        $val = $this->validate();
        $this->andaze->save($val);
        $this->js('$wire.$parent.$refresh()');
    }

}

?>

<div>
    <label for="">
        <input type="checkbox" wire:model.live="andaze.active">
    </label>
</div>
