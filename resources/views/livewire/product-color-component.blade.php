<div class="flex mx-auto text-center items-center justify-center">
    <button
        {{--                            wire:click.prefetch="selectColor({{$color->id}})"--}}
        wire:click="selectColor('{{$color->id}}')"
        {{--                            @click="color=true"--}}
        class="p-1 focus:outline-none">
        <img class="w-full object-cover bg-gray-100 p-1"
             src="{{ $color->getFirstMediaUrl('colors', 'preview') }}" alt="">
    </button>
    {{--                        @if($selectedColor)--}}
    {{--                            <div x-show="color" x-cloak>--}}
    {{--                                <livewire:show-color :color="$selectedColor" wire:key="show-color-{{$selectedColor}}"/>--}}
    {{--                            </div>--}}
    {{--                        @endif--}}
</div>
