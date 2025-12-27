<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

new class extends Component {

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
        return $this->redirect(route('home'));
    }

}; ?>

<div>
    <button wire:click="logout">خروج</button>
</div>
