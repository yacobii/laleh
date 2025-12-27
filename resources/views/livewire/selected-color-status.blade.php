<?php

use  Livewire\Volt\Component;
use App\Models\Variation;

new class extends Component {

    public $variation;

    protected $rules = [
        'variation.selected' => 'boolean'
    ];


    public function updated($prop)
    {
        // Validate the property before saving
        $val = $this->validateOnly($prop);
        // Use update or save with argument
        $this->variation->save($val);
     $this->js('$wire.$refresh()');
    }

}

?>

<div class="">
    <option value="">
        <select name="" id=""></select>
    </option>
<button
    @class([
        'py-1 px-3 text-white bg-gray-500 focus:outline-none text-xs rounded-lg',
        'bg-green-500' => $variation->selected,
])
    wire:click.prevent="$toggle('variation.selected')">
    <span>انتخاب</span>
</button>
</div>
