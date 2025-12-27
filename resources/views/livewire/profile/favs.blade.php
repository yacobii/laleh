<?php

use Livewire\Volt\Component;

new class extends Component {

    #[\Livewire\Attributes\Computed]
    public function favorites()
    {
        return \App\Models\Product::whereHasFavorite(
            auth()->user()
        )->get();
    }

}; ?>

<div>
    @if(count($this->favorites))
        <div class="bg-white profile-card rounded-xl p-6 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-5 text-center gap-3">
                @foreach($this->favorites as $fav)
                    <a href="{{ route('product', $fav) }}" class="py-3 grid gap-3" wire:key="{{ $fav->id }}">
                        <img class="w-full object-cover aspect-square" src="{{ $fav->getFirstMediaUrl('products', 'preview') }}" alt="favourite-{{$fav->title}}">
                        <p>{{ $fav->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
