<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Success extends Component
{


    use WithPagination;

    public $term;

    public $page = 10;

    #[Computed]
    public function orders()
    {
        return Order::query()
            ->with(['items.order.coupon', 'coupon', 'dargah', 'user', 'items.variation.product', 'orderToken', 'items.variation.parent.media'])
            ->where('payment_status', 1)
            ->latest()
            ->paginate(10);
    }


    public function loadMore()
    {
        $this->page += 10;
    }
    #[On('refresh')]
    public function render()
    {
        return view('livewire.admin.orders.success');
    }
}
