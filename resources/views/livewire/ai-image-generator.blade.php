<div class="p-20">

    <div>
        <textarea wire:model="prompt" class="w-full min-h-64"></textarea>
        <button wire:click="generateContent" class="p-5 outline-none">SEND</button>
        <x-errors />
    </div>

    <div>
        @if(!is_null($res))
            <div>
                {{ $res }}
            </div>
        @endif
    </div>
</div>
