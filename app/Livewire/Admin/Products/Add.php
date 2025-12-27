<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;

class Add extends Component
{

    use WithFileUploads;




    #[Validate('required', message: 'عنوان ؟')]
    #[Validate('unique:products,title', message: 'عنوان قبلا ثبت شده')]
    public $title;

    #[Validate('required', message: 'توضیحات ؟')]
    public $body;

    #[Validate('required', message: 'قیمت ؟')]
    #[Validate('numeric:', message: 'عدد')]
    public  $price;


    #[Validate('required', message: 'دسته بندی ؟')]
    public $selected;
    public $child_id;




    public function save()
    {
        $this->validate();

        $product = Product::create([
            'category_id' => $this->child_id ?? $this->selected,
            'title' => $this->title,
            'price' => $this->price,
            'body' => $this->body,
            'active' => false,
        ]);
        $this->reset('title', 'price', 'body');


        return $this->redirect(route('product.gallery', $product));
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
        return view('livewire.admin.products.add');
    }
}
