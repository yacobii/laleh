<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Component
{

    use WithFileUploads;

    public Product $product;

    #[Validate(['images.*' => 'image'])]
    public $images = [];

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function updatedImages()
    {
        $this->validate();
        foreach ($this->images as $image) {
            $filename = str()->slug($this->product->title, '-', null) . '.' . $image->getClientOriginalExtension();
            $this->product->addMedia($image)
                ->usingFileName($filename)
                ->toMediaCollection('products');
        }
        $this->product->load('media');
        $this->images = [];
    }

    public function dilit(Media $media)
    {
        $media->delete();
        $this->product->load('media');
    }

    public function updateOrder($order)
    {
        foreach ($order as $item) {
            Media::where('id', $item['value'])->update(['order_column' => $item['order']]);
        }
        $this->product->load('media');

    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.gallery');
    }
}
