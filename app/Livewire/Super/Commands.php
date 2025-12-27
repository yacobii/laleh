<?php

namespace App\Livewire\Super;

use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Commands extends Component
{

    public $progress = '';

    public function clear(): void
    {
        $this->progress = 'Starting clear...';
        Artisan::call('optimize:clear');
        $this->progress = 'Cache cleared successfully!';
        $this->js('$wire.$refresh()');
    }



    public function optimize(): void
    {
        $this->progress = 'Starting optimize...';
        Artisan::call('optimize');
        $this->progress = 'Cache optimized successfully!';
        $this->js('$wire.$refresh()');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.super.commands');
    }
}
