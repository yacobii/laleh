<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;

    public $selected;
    public $child_id;

    public $title;


    public function rules()
    {
        return [
            'product.title' => ['required', Rule::unique('products', 'title')->ignore($this->product->id)],
            'product.body' => 'nullable|string',
            'product.price' => 'numeric',
            'product.category_id' => 'numeric',
            'product.discount_rate' => 'nullable|numeric',
        ];
    }


    protected $messages = [
        'product.price' => 'عدد',
    ];

    public function updated()
    {
        $this->validate();
        if ($this->product->category_id == null) {
            return false;
        }
        $this->product->save();
        $this->js('$wire.$refresh()');
    }

public function updatedSelected()
{
    if (is_null($this->selected)) {
        return;
    }
}



    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->get();
    }

    #[Computed]
    public function children()
    {
        return Category::query()->find($this->selected)?->children;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.products.edit');
    }
}
