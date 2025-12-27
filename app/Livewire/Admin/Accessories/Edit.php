<?php

namespace App\Livewire\Admin\Accessories;

use App\Models\Accessory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;
    public $accessory;
    public $image;

    public function rules()
    {
        return [
            'accessory.name' => '',
            'accessory.price' => 'numeric',
            'accessory.description' => 'string',
        ];
    }

    public function mount(Accessory $accessoryID)
    {
        $this->accessory = $accessoryID;
    }


    public function updated($property)
    {
        $vval = $this->validateOnly($property);
        $this->accessory->save($vval);
$this->dispatch('updated')->to('admin.accessories.accessories');
    }


    public function updatedImage() {
        $this->accessory->clearMediaCollection('accessories') ?? null;
        $this->accessory->addMedia($this->image)->preservingOriginal()->toMediaCollection('accessories');
        $this->dispatch('updated')->to('admin.accessories.accessories');
    }
    public function render()
    {
        return view('livewire.admin.accessories.edit');
    }
}
