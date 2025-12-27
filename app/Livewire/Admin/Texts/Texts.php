<?php

namespace App\Livewire\Admin\Texts;

use App\Models\Text;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Texts extends Component
{
    #[Validate('required')]
    #[Validate('unique:texts,title')]
    public $title;

    #[Computed]
    public function texts()
    {
        return Text::query()->get();
    }

    public function save()
    {
        $this->validate();

        $txt = Text::create(['title' => $this->title, 'body' => 'متن بنویسید']);
        return $this->redirect(route('admin.texts.edit', $txt));
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.texts.texts');
    }
}
