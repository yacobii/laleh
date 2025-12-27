<?php

namespace App\Livewire;

use App\Models\Text;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AboutUs extends Component
{

    #[Computed]
    public function txt()
    {
        return Text::query()->find(5)->body;
    }

    public function render()
    {
        return view('livewire.about-us');
    }
}
