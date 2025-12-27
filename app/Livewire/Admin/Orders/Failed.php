<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Failed extends Component
{



    use WithPagination;

    public $term;

    #[Computed]
    public function orders()
    {
        $term = $this->term;
        return Order::query()
            ->with(['items.order.coupon', 'coupon', 'dargah', 'user', 'items.variation.product', 'orderToken', 'items.variation.parent.media'])
            ->where('payment_status', false)
            ->orWhere('payment_status', null)
            ->latest()
            ->paginate(10);
    }



    #[On('refresh')]
    public function render()
    {
        return view('livewire.admin.orders.failed');
    }
}
