<?php
use Livewire\Volt\Component;
use \App\Models\Category;
new class extends Component {

    public $categories;

    public function mount()
    {
        $this->categories = Category::with('children')->parent()->get();
    }


}

?>

<div class="divide-y">
    @foreach($categories as $category)
        <li
            x-data="{open:false}"
            class="">
            <div class="py-3 flex items-center justify-between">
                <span>{{ $category->name }}</span>
                <span @click="open = !open">
                <svg x-show="open === false" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
</svg>
<svg x-show="open === true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
     class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
</svg>

            </span>
            </div>

            <div x-show="open" @click.outside="open=false" x-cloak class="space-y-2 py-4">
                @foreach($category->children as $child)
                    <p class="text-sm mr-3">{{ $child->name }}</p>
                @endforeach
            </div>




        </li>


    @endforeach
</div>
