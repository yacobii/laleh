<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class Categories extends Component
{

    public Category $category;

    public $tab = 1;
    public function render()
    {
        return view('livewire.categories');
    }
}
