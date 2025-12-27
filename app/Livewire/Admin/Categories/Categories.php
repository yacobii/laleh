<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Categories extends Component
{



    use WithFileUploads;

    public Category $category;

    public $term;

    #[Validate('required')]
    public $title;

    public $selected;

    public $page = 10;
    public $selected_category;



    public function save()
    {
        $this->validate();

        Category::create([
            'title' => $this->title,
            'parent_id' => $this->selected,
        ]);
        $this->reset(['title', 'selected']);
    }


    #[Computed]
    public function categories()
    {
        $term = '%'.$this->term.'%'; // Store the term for reuse

        return Category::query()
            ->withCount('products')
            ->with(['descendants' => fn($q) => $q->withCount('products')])
            ->where('title', 'like', $term) // Search in root category title
            ->orWhereHas('children', function ($query) use ($term) {
                $query->where('title', 'like', $term); // Search in descendant titles
            })
            ->isRoot() // Ensure we only return root categories in the main collection
            ->latest()
            ->simplePaginate($this->page);
    }

    public function loadMore()
    {
        $this->page += 10;
    }

    public function updateCategory()
    {
        $this->category->save();
    }

    #[On('refresh')]
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.categories');
    }
}
