<div class="p-1 md:p-10 w-full">

    <div class="flex flex-col md:flex-row mt-6 gap-4 bg-gray-200 p-5">
        <div class="flex items-start gap-4">
            <select wire:model.live="selected">
                <option value="">دسته بندی</option>
                @foreach($this->categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <input type="text" wire:model="title" placeholder="عنوان ..."
               class="h-10 w-full {{ $errors->has('title') ? 'border-red-500' : '' }}">
        <button @disabled(!auth()->user()->hasRole('super')) wire:click="save" class="disabled:bg-gray-500 h-10 px-5 bg-black shrink-0 text-white outline-none">اضافه‌ کردن</button>
    </div>

    <div class="my-5 p-1">
        <p class=" border-b pb-1">لیست دسته بندی‌ها</p>
        <div>
            <input type="search" class="w-full" wire:model.live.debounce="term" placeholder="جستجو...">
        </div>
        <div class="space-y-10 grid gap-4 mt-5">
            @foreach($this->categories as $category)
                <div wire:key="{{ $category->id }}">
                    <div class="grid gap-1 p-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="font-bold">
                            @role('super')[{{$category->id}}] @endrole {{ $category->title }}
                            <span>({{ $category->products_count }})</span>
                        </a>

                        <div class="grid">
                            @foreach($category->descendants as $child)
                                <div class="flex gap-1 mt-1 mr-3" wire:key="{{$child->id}}">
                                    <a href="{{ route('admin.categories.edit', $child) }}"
                                       class="mr-{{$child->depth + 1}}">@role('super')[{{$child->id}}
                                        ] @endrole  {{ $child->title }}</a>
                                    <span>({{ $child->products_count }})</span>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @if($this->categories()->hasMorePages())
        <div x-data x-intersect="$wire.loadMore">
            loading
        </div>
    @endif
</div>
