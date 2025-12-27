<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Item;
use App\Models\Order;
use App\Models\Variation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class SingleOrder extends Component
{
    public Order $order;


    public function changeStatus($type)
    {

        $this->order->status = $type;
        $this->order->save();
        $this->dispatch('refresh');
    }











    public function subtractQTY(Item $item, $qty)
    {

        $item->qty = $qty - 1;
        $item->save();


        $this->js('$wire.$parent.$refresh()');
        $this->js('$wire.$refresh()');
    }



    public function addtQTY(Item $item, $qty)
    {

        $item->qty = $qty + 1;
        $item->save();
        $item->order->total = $item->order->total + $item->price;
        $item->order->save();
        $this->updateSnapp();
        $this->js('$wire.$parent.$refresh()');
        $this->js('$wire.$refresh()');
    }







    #[On('refresh')]
    public function render()
    {
        return view('livewire.admin.orders.single-order');
    }
}
