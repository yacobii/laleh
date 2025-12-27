<?php

namespace App\Livewire\Admin\Stocks;

use App\Models\Variation;
use Livewire\Attributes\On;
use Livewire\Component;

class Active extends Component
{

    public $variation;


    protected $rules = ['variation.active' => 'boolean'];

    public function mount()
    {
        if ($this->variation->stockCount() === 0) {
            $this->variation->active = false;
            $this->variation->save();
        }
        $this->js('$wire.$parent.$refresh()');
    }

    #[On('updatestock')]
    public function updatestock()
    {
        if ($this->variation->stockCount() === 0) {
            $this->variation->active = false;
            $this->variation->save();
        }
        $this->js('$wire.$parent.$refresh()');
    }

    public function updated($prop)
    {
        $val = $this->validateOnly($prop);
        $this->variation->save($val);
    }

    #[On('refresh')]
    public function render()
    {
        return view('livewire.admin.stocks.active');
    }
}
