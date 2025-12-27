<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;

class HeaderCategories extends Component
{



    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->get();
    }


    public function render()
    {

        return view('livewire.header-categories');
    }
}
