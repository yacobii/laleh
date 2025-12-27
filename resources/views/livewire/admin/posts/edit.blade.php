<div class="p-1 md:p-10">
<div class="fixed top-2 md:top-20 left-2 md:left-20">
    <button wire:confirm class="outline-none text-red-500" wire:click="dilit">x</button>
</div>
    <div class="mb-5 flex  items-center gap-5">
        <a href="{{ route('admin.posts') }}">
            <x-icons.chevron-left class="size-4"/>
        </a>
{{--        <a target="_blank" href="{{ route('post', $post) }}">--}}
{{--            <x-icons.eye class="size-4"  />--}}
{{--        </a>--}}
        <p>words: {{ word_count($post->body) }}</p>
    </div>

    <div class="flex flex-col md:flex-row items-start gap-2 md:gap-4 w-full">

        <div class="w-full grid gap-5 md:w-8/12">
            <input type="text" wire:model.live.debounce="post.title" class="w-full" placeholder="title">
            @role('super')
            <input type="text" wire:model.live.debounce="post.slug" class="w-full ltr" placeholder="slug">
            @endrole
            <div class="flex items-center gap-5">

                <select wire:model.live="post.category_id" class="w-full">
                    <option value="">دسته بندی</option>
                    @foreach($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="format">
                <textarea class="w-full p-5" x-data x-autosize wire:model.live.debounce="post.body" ></textarea>
            </div>


            <x-errors/>
        </div>
        <div class="w-full flex-1 sticky top-14">
            <livewire:admin.posts.gallery :$post/>
{{--            <div class="text-left grid justify-end">--}}
{{--                <button--}}
{{--                    wire:click="save"--}}
{{--                    class="outline-none w-20 h-10 bg-black text-white grid place-items-center">--}}
{{--                    <span wire:loading.remove wire:target="save">آپدیت</span>--}}
{{--                    <span wire:loading wire:target="save"><x-icons.spin class="size-5 animate-spin"/></span>--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>


    </div>

    <div class="fixed top-16 right-10">
<x-icons.spin wire:loading class="size-8 animate-spin" />
    </div>
</div>

{{--@assets--}}
{{--<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">--}}
{{--<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>--}}
{{--@endassets--}}

{{--@script--}}
{{--<script>--}}
{{--    const easyMDE = new EasyMDE({--}}
{{--        element: document.getElementById('easymde'),--}}
{{--        spellChecker: false,--}}
{{--        direction: 'rtl',--}}
{{--        autosave: {--}}
{{--            enabled: true,--}}
{{--            uniqueId: "post_body_editor",--}}
{{--            delay: 1000,--}}
{{--        },--}}
{{--        toolbar: [--}}
{{--            "bold", "italic", "heading", "|",--}}
{{--            "quote", "unordered-list", "ordered-list", "|",--}}
{{--        ],--}}
{{--        status: false,--}}
{{--        // status: ['autosave', 'lines', 'words', 'cursor']--}}
{{--    });--}}

{{--    // Initialize with the current value--}}
{{--    easyMDE.value($wire.post.body || '');--}}

{{--    // Listen for changes and update Livewire--}}
{{--    easyMDE.codemirror.on('change', function () {--}}
{{--        $wire.set('post.body', easyMDE.value());--}}
{{--    });--}}

{{--    // Listen for Livewire updates--}}
{{--    $wire.on('post-updated', () => {--}}
{{--        easyMDE.value($wire.post.body || '');--}}
{{--    });--}}
{{--</script>--}}


{{--@endscript--}}
