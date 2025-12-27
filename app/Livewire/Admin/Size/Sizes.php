<?php

namespace App\Livewire\Admin\Size;

use App\Models\Category;
use App\Models\Size;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Sizes extends Component
{

    #[Validate('nullable')]
    public $idd = 1;



    public $title;

    protected function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                Rule::unique('sizes')->where(function ($query) {
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

        Size::create([
            'category_id' => $this->idd,
            'title' => $this->title
        ]);
        $this->reset('title');
        $this->resetValidation('title');
        $this->dispatch('refresh')->to('admin.size.list');
    }

    #[Computed]
    public function categories()
    {
        return Category::query()->isRoot()->get();
    }



    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.size.sizes');
    }
}
