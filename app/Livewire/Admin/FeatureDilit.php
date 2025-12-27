<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FeatureDilit extends Component
{

    public $feature;

    public function dilit() {
        $this->feature->delete();
        $this->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.admin.feature-dilit');
    }
}
