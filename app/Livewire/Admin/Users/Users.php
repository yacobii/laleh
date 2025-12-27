<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Users extends Component
{


    public $term;

    #[Computed]
    public function users()
    {
        return User::query()
            ->whereAny(['name', 'mobile'], 'like', '%'.$this->term.'%')
            ->paginate(10);
    }


    public function dilitUser(User $user)
    {
        $user->delete();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.users.users');
    }
}
