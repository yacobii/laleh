<?php

namespace App\Livewire\Admin\Texts;

use App\Models\Text;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{

    public Text $text;

    protected function rules()
    {
        return [
          'text.title' => 'string',
          'text.body' => 'string',
        ];
    }

    public function updated()
    {
        $this->validate();
        $this->text->save();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.texts.edit');
    }
}
