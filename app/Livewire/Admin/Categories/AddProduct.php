<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProduct extends Component
{


    use WithFileUploads;


    public Category $category;


    #[Validate('required', message: 'عنوان ؟')]
    #[Validate('unique:products,title', message: 'عنوان قبلا ثبت شده')]
    public $title;

    public $body;


    public  $price;
    public $images = [];



    protected function messages()
    {
        return [
            'title.required' => '?',
            'title.unique' => 'عنوان قبلا ثبت شده',
            'price.numeric' => 'عدد',
        ];
    }


    public function save()
    {
        $this->validate();

        $product = Product::create([
            'category_id' => $this->category->id,
            'title' => $this->title,
            'price' => $this->price,
            'body' => $this->body,
        ]);
        $this->reset('title', 'price');


        return $this->redirect(route('product.gallery', $product));
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.add-product');
    }
}
