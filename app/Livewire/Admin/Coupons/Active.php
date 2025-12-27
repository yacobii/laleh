<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Component;

class Active extends Component
{

    public Coupon $coupon;

    protected $rules = ['coupon.active' => 'boolean'];


    public function mount()
    {
        if ($this->coupon->amount < 1) {
            $this->coupon->active = false;
            $this->coupon->save();
            $this->js('$wire.$partent.$refresh()');
        }
    }

    public function updated()
    {
        $val = $this->validate();
        $this->coupon->save($val);
    }

    public function dilit()
    {
        $this->coupon->delete();
        $this->js('$wire.$partent.$refresh()');
    }

    public function render()
    {
        return view('livewire.admin.coupons.active');
    }
}
