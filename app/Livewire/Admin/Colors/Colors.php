<?php

namespace App\Livewire\Admin\Colors;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Colors extends Component
{

    public $idd = 1;


    public $title;

    protected function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('colors')->where(function ($query) {
                    return $query->where('category_id', $this->idd);
                })
            ]
        ];
    }

    protected function messages()
    {
        return [
            'title.required' => 'سایز ؟',
            'title.unique' => 'قبلا ثبت شده',
        ];

    }

    public function add()
    {

        $this->validate();

        // Create the color with the category_id
        Color::create([
            'category_id' => $this->idd,
            'title' => $this->title
        ]);

        $this->reset('title');
        $this->dispatch('refresh')->to('admin.colors.list');
    }

    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->get();
    }


    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.colors.colors');
    }
}
