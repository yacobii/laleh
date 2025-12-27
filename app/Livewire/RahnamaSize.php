<?php

namespace App\Livewire;

use Livewire\Component;

class RahnamaSize extends Component
{
    public $product;


    public function placeholder(): string
    {
        return <<<'HTML'
        <div class="text-center text-sm text-gray-400 pt-2">
            <span class="">loading...</span>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.rahnama-size');
    }
}
