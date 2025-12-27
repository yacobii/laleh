<?php

use Livewire\Volt\Component;

new class extends Component {

    public $color;

    public function mount(\App\Models\Color $color)
    {
        $this->color = $color;
    }

}

?>

<div>
    <div @click="color=false"
         class="fixed w-full md:max-w-screen-xl mx-auto inset-0 bg-gray-800 grid place-items-center z-[99] p-3">
        <div>
            @if($this->color->hasMedia('colors'))
                <img class="w-full object-cover" src="{{ $this->color->getFirstMediaUrl('colors') }}" alt="">
            @else
                <p class="text-white">No Image ....</p>
            @endif
        </div>
    </div>
</div>
