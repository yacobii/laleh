<?php

namespace App\Livewire\Admin\Users;

use Livewire\Component;

class Orders extends Component
{
    public $order;


    public function deilitOrder()
    {
        $this->order->delete();
        $this->js('$wire.$parent.$refresh()');
    }
    public function render()
    {
        return view('livewire.admin.users.orders');
    }
}
