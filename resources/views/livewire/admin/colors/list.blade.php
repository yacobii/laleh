<?php

use Livewire\Attributes\Computed;
use Livewire\Volt\Component;

new #[\Livewire\Attributes\On('refresh')] class extends Component {

    public $category_id;

    public function mount($category_id)
    {
        $this->category_id = $category_id;
    }

    #[Computed]
    public function sizes()
    {
        return \App\Models\Color::query()->where('category_id', $this->category_id)->get();
    }

}; ?>

<div>
    <div class="md:space-y-4">
        @foreach($this->sizes as $size)
            <div class="flex items-center gap-x-3">
                <livewire:admin.size.delete :size="$size" wire:key="delete-{{$size->id}}"/>
                <p>{{ $size->title }}</p>
            </div>
        @endforeach
    </div>
</div>
