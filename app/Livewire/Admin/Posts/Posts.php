<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Posts extends Component
{

    #[Validate('required')]
    #[Validate('unique:posts,title')]
    public $title;

    public function save()
    {
        $this->validate();
        $post = Post::create([
            'title' => $this->title,
        ]);

        $this->reset('title');
        return to_route('admin.posts.edit', $post);
    }

    public $progress = '';

    #[Computed]
    public function posts()
    {
        return Post::query()->latest()->get();
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.posts');
    }
}
