<?php

namespace App\Livewire\Admin\Colors;

use App\Models\Variation;
use Livewire\Component;

class Active extends Component
{

    public Variation $variation;

    protected $rules = [
        'variation.active' => 'boolean'
    ];


    public function updated($prop)
    {
        $val = $this->validateOnly($prop);
        $this->variation->save($val);
        $this->js('$wire.$refresh()');
    }

    public function render()
    {
        return view('livewire.admin.colors.active');
    }
}
