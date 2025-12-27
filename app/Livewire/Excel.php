<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Excel extends Component
{

    #[Computed]
    public function products()
    {
        return Product::query()->where('active', true)
            ->whereRelation('variations', 'active', true)
            ->get();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.excel');
    }
}
