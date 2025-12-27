<?php

namespace App\Livewire\Admin\Products;

use App\Models\Size;
use App\Models\Variation;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use  Illuminate\Support\Facades\Validator;

class ColorsEdit extends Component
{

    use WithFileUploads;

    public Variation $variation;

    public $images = [];


    protected $rules = [
        'variation.title' => 'string',
        'variation.code' => 'string',
        'variation.sku' => 'nullable|string',
    ];

    public function updated(): void
    {
        $this->validate();
        $this->variation->save();
        $this->dispatch('refresh')->to('admin.products.colors');
    }


    public function updatedImages(): void
    {

        foreach ($this->images as $image) {
            $this->variation->addMedia($image)->toMediaCollection('colors');
        }
        $this->js('$wire.$refresh()');

    }


    public function dilitImage(Media $item): void
    {
        $item->delete();
        $this->js('$wire.$refresh()');
    }


    public function updateImageOrder($order): void
    {

        foreach ($order as $item) {
            Media::find($item['value'])->update(['order_column' => $item['order']]);
        }


        $this->variation->load('media');

    }


    public function render()
    {
        return view('livewire.admin.products.colors-edit');
    }
}
