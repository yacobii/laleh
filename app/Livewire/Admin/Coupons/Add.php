<?php

namespace App\Livewire\Admin\Coupons;

use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Add extends Component
{

    public $title = '';
    public $code = '';
    public $count;
    public $percentage = '';
    public $active = true;
    public $expired_at = '';

    protected $rules = [
        'title' => 'required|unique:coupons,title|min:3',
        'code' => 'required|unique:coupons,code|min:3',
        'count' => 'nullable|numeric',
        'percentage' => 'required|numeric|between:0,100',
        'active' => 'boolean',
        'expired_at' => 'nullable|date|after:today',
    ];

//    protected $messages = [
//        'title.required' => 'The coupon code is required.',
//        'title.unique' => 'This coupon code already exists.',
//        'code.reqyui' => ' addad.',
//        'code.numeric' => ' addad.',
//        'title.min' => 'The coupon code must be at least 3 characters.',
//        'percentage.required' => 'Please specify a discount percentage.',
//        'percentage.between' => 'The discount must be between 0 and 100.',
//        'expired_at.after' => 'The expiration date must be after today.',
//    ];

    public function save()
    {
        $this->validate();

        Coupon::create([
            'title' => $this->title,
            'code' => $this->code,
            'count' => $this->count,
            'percentage' => $this->percentage,
            'active' => $this->active,
            'expired_at' => $this->expired_at ?: null,
        ]);

        session()->flash('message', 'Coupon created successfully.');

        $this->reset();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.coupons.add');
    }
}
