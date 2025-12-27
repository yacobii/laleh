<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use Livewire\Component;
use Livewire\WithFileUploads;

class FeaturesEdit extends Component
{

    use WithFileUploads;

    public $feature;

    public $image;

    protected $rules = [
        'feature.title' => 'string'
    ];


    public function mount(Feature $feature)
    {
        $this->feature = $feature;
    }

    public function updatedImage()
    {
            $this->feature->clearMediaCollection('features') ?? null;
        $this->feature->addMedia($this->image)->toMediaCollection('features');
    }


    public function updated($property)
    {
        $val = $this->validateOnly($property);
        $this->feature->save($val);
        $this->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.admin.products.features-edit');
    }
}
