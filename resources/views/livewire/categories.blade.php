<div class="size pt-20">

    <div class="">
        <h1 class="text-center text-2xl py-5">{{ $category->title }}</h1>

        <div>
            <livewire:categories.children :$category  />
        </div>
    </div>

</div>
