<?php

namespace App\Livewire\Admin\Features;

use App\Models\Feature;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
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
        $this->feature->addMedia($this->image)->preservingOriginal()->toMediaCollection('features');
    }


    public function updated($property)
    {
        $val = $this->validateOnly($property);
        $this->feature->save($val);
        $this->dispatch('feature')->to('admin.features.features');
    }

    public function render()
    {
        return view('livewire.admin.features.edit');
    }
}
