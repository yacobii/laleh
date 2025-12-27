<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Coupons extends Component
{

    #[Computed]
    public function coupons()
    {
        return Coupon::all();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.coupons.coupons');
    }
}
