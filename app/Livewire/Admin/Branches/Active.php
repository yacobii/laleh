<?php

namespace App\Livewire\Admin\Branches;

use Livewire\Component;

class Active extends Component
{

    public $branch;

    protected $rules = ['branch.active' => 'boolean'];


    public function updated()
    {
        $this->branch->save();
    }

    public function render()
    {
        return view('livewire.admin.branches.active');
    }
}
