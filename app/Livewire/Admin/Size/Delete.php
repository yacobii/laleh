<?php

namespace App\Livewire\Admin\Size;

use Livewire\Component;

class Delete extends Component
{

    public $size;

    public function dilit() {
        $this->size->delete();
        $this->js(('$wire.$parent.$refresh()'));
    }

    public function render()
    {
        return view('livewire.admin.size.delete');
    }
}
