<div>
    <div class="p-10 grid gap-5">
        <div>
            <a href="{{ route('admin.texts') }}"><x-icons.arrow-left class="size-4" /></a>
        </div>
        <div class="grid gap-5 ">
            <input type="text" wire:model.live.debounce="text.title" placeholder="title..." class="w-full h-10">
            <textarea wire:model.live.debounce="text.body" class="field-sizing-content"></textarea>
        </div>
    </div>
</div>
