<?php

use Livewire\Volt\Component;

new class extends Component {

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
}; ?>

<div>
    <div class="p-20">
        <div class="flex flex-col gap-5 items-start">
            <button class="outline-none" wire:click="clear">clear</button>
            <a target="_blank" href="/sitemap" class="outline-none" wire:click="clear">sitemap</a>
            <button class="outline-none" wire:click="optimize">optimize</button>
            <p>{{ $progress }}</p>
        </div>

    </div>


</div>
