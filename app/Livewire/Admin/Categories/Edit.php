<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public Category $category;

    #[Validate('nullable')]
    public $parent_id;

    #[Validate('nullable|image')]
    public $image;

    protected $rules = [
      'category.title' => 'string',
      'category.body' => 'nullable',
      'category.active' => 'boolean',
    ];

    public function updatedImage()
    {
        $filename = str()->slug($this->category->title, '-', null) . '.' . $this->image->getClientOriginalExtension();

        $this->category
            ->clearMediaCollection('category')
            ->addMedia($this->image)
            ->usingFileName($filename)
            ->UsingName(str()->slug($this->category->title, '-', null))
            ->toMediaCollection('category');
    }

    public function dilit()
    {
        $this->category->delete();
        return to_route('admin.categories');
    }

    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->latest()->get();
    }

    public function updated()
    {
        $this->validate();
        $this->category->parent_id = $this->parent_id ?? $this->category->parent_id;
        $this->category->save();
        $this->js('$wire.$refresh()');
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.edit');
    }
}
