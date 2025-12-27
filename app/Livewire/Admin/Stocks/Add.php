<?php

namespace App\Livewire\Admin\Stocks;

use App\Models\Variation;
use Livewire\Component;

class Add extends Component
{

    public Variation $variation;

    public $amount;

    public function add()
    {

        $this->variation->stocks()->updateOrCreate(
            ['variation_id' => $this->variation->id],
            ['amount' => $this->amount]
        );
        $this->js('$wire.$parent.$refresh()');

    }

    public function render()
    {
        return view('livewire.admin.stocks.add');
    }
}
