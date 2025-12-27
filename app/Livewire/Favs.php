<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Favs extends Component
{

    public $user;


    public function mount()
    {
        $this->user = auth()->user();
    }

    #[Computed]
    public function products()
    {
        return $this->user->products;

    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.favs');
    }
}
