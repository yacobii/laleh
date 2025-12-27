<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Edit extends Component
{

    public Post $post;


    public $category_id;

    public function rules()
    {
        return [
          'post.title' => 'string',
          'post.body' => 'string',
          'post.slug' => 'string',
          'post.active' => 'boolean',
          'post.category_id' => 'integer',
        ];
    }

    public function updated()
    {
        $this->validate();
        $this->post->save();
    }

    #[Computed]
    public function categories()
    {
        return Category::all();
    }

    public function dilit() {
        $this->post->delete();
    }
    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.posts.edit');
    }
}
