<div class="p-10 ">
    <div class="flex flex-col gap-5 items-start">
        <button class="outline-none" wire:click="clear">clear</button>
        <a target="_blank" href="/sitemap" class="outline-none" wire:click="clear">sitemap</a>
        <button class="outline-none" wire:click="optimize">optimize</button>
        <p>{{ $progress }}</p>
    </div>

</div>

