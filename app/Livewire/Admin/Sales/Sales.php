<?php

namespace App\Livewire\Admin\Sales;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Sales extends Component
{



    #[Computed]
    public function sales()
    {

        return Order::with(['items.order.copen']) // 👈 eager load everything needed
        ->where('payment_status', true)
            ->get()
            ->groupBy(function ($order) {
                return \Illuminate\Support\Carbon::parse($order->created_at)->toDateString();
            })
            ->map(function ($orders, $date) {
                return [
                    'date' => $date,
                    'daily_total' => $orders->sum(fn($order) => $order->sum()),
                ];
            })
            ->sortByDesc('date')
            ->values();
    }



    public function render()
    {
        return view('livewire.admin.sales.sales');
    }
}
