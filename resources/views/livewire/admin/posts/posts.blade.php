<div class="p-1 md:p-10">
    <div class="py-10">
        <form wire:submit="save" class="grid gap-4 mx-auto">
            <input type="text" class="" wire:model="title" placeholder="عنوان">
            <div class="text-left">
                <button type="submit" class="bg-black text-sm text-white h-12 px-4">ایجاد پست</button>
            </div>
        </form>

        <x-errors/>
    </div>


    <div class="grid gap-5">
    @foreach($this->posts as $post)
        <div wire:key="{{ $post->id }}">
            <a href="{{ route('admin.posts.edit', $post) }}">
                <p>{{ $post->title }}</p>
            </a>
        </div>
    @endforeach
</div>
</div>
