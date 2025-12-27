<div>
<div class="p-10">
<div class="flex ">
    <input type="text" wire:model="title" placeholder="title..." class="w-full h-10">
    <button wire:click="save" class="h-10 px-5 outline-none">Add</button>
</div>

    <div>
        @foreach($this->texts as $text)
            <div wire:key="{{ $text->id }}">
                @can('super')<span>[{{$text->id}}]</span>@endcan
                <a href="{{ route('admin.texts.edit', $text) }}">{{ $text->title }}</a>
            </div>
        @endforeach
    </div>
</div>
</div>
