<?php

use Livewire\Volt\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

new class extends Component {

    use  \Livewire\WithFileUploads;

    public \App\Models\Post $post;

    #[\Livewire\Attributes\Validate('required')]
    public $images = [];

    public function updatedImages()
    {
        $this->validate();
        foreach ($this->images as $image) {
            $filename = str()->slug($this->post->title, '-', null) . '.' . $image->getClientOriginalExtension();
            $this->post->addMedia($image)
                ->usingFileName($filename)
                ->UsingName($filename)
                ->toMediaCollection('posts');

        }

        $this->post->load('media');
    }

    public function dilit(Media $media)
    {
        $media->delete();
        $this->post->load('media');
    }


    public function updateOrder($order)
    {
        foreach ($order as $item) {
           Media::where('id', $item['value'])->update(['order_column' => $item['order']]);
        }
        $this->post->load('media');

    }

}; ?>

<div class="w-full">
    <label for="images" class="grid place-items-center">
        <p class="w-full py-1 text-center bg-gray-200" wire:loading.remove wire:target="images">images</p>
        <p class="w-full py-1 text-center bg-gray-200" wire:loading wire:target="images">wait...</p>
        <input id="images" type="file" wire:model.live.debounce="images" multiple class="sr-only">
    </label>

    <div class="grid grid-cols-3 gap-3 my-3" wire:sortable="updateOrder">
        @foreach($post->getMedia('posts') as $media)
            <div wire:key="{{ $media->id }}" wire:sortable.item="{{ $media->id }}" class="relative text-center">
                <img wire:sortable.handle class="object-cover w-full h-20" src="{{ $media->getUrl('preview') }}" alt="مهدیس آسانبر">
                <button
                    wire:confirm=""
                    wire:click="dilit({{$media->id}})"
                    class="text-sm text-red-500 absolute top-2 left-2">x
                </button>
                <div x-data="{ copyHtml: `<div class='image'><img src='{{ $media->getUrl('post') }}' alt='{{ $post->title }}'></div>` }">
                    <button
                        class="text-xs text-center"
                        @click="$clipboard(copyHtml)">
                        Copy
                    </button>
                </div>
            </div>
        @endforeach
    </div>


</div>
