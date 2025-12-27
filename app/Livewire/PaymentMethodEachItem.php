<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class PaymentMethodEachItem extends Component
{

    public $item;


    public function render()
    {
        return view('livewire.payment-method-each-item');
    }
}
