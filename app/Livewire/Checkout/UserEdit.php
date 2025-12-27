<?php

namespace App\Livewire\Checkout;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserEdit extends Component
{


    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    #[On('showedit')]
    public function showEdit()
    {
        $this->show_edit = true;
    }

    public bool $show_edit = false;


    public function render()
    {
        return view('livewire.checkout.user-edit');
    }
}
