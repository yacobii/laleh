<?php

namespace App\Livewire\Front;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Posts extends Component
{
    public $post;

    public function render()
    {
        return view('livewire.front.posts');
    }
}
