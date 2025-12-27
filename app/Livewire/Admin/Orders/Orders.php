<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{

    use WithPagination;

    public $term;

    #[Computed]
    public function orders()
    {
        $term = $this->term;

        $query = Order::query()->with(['user', 'items.product'])->latest();

        if (!empty($term)) {
            $query->whereHas('user', function ($q) use ($term) {
                $q->whereAny(['name', 'mobile'], 'like', "%{$term}%");
            });
        }

        return $query->paginate(10);
    }


    public $status;


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.orders.orders');
    }
}
