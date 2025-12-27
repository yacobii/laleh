<?php

namespace App\Livewire\Admin\Accessories;

use App\Models\Accessory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Accessories extends Component
{

    use WithFileUploads;

    public $accessoryID = null;


    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '?',
            'price.numeric' => 'عدد',
        ];
    }

    public $name;
    public $description;


    public $price;

    public $image;


    #[Computed]
    public function accessories()
    {
        return Accessory::all();
    }

    public function dilit(Accessory $accessory)
    {
        $accessory->delete();
    }

    public function add()
    {
        $val = $this->validate();
        $accessory = Accessory::create($val);

        if ($this->image) {
            $accessory->addMedia($this->image)->preservingOriginal()->toMediaCollection('accessories');
        }

        $this->reset();
    }

    #[On('updated')]
    public function render()
    {
        return view('livewire.admin.accessories.accessories');
    }
}
