<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;

class EditHeader extends Component
{
    public $product;

    protected $rules = [
      'product.active' => 'boolean'
    ];

    public function updated($prop) {
        $val = $this->validateOnly($prop);
        $this->product->save($val);
    }

    public function render()
    {
        return view('livewire.admin.product.edit-header');
    }
}
