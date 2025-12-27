<div class="md:px-10 py-5 relative">

    <div class="w-full grid gap-6">
        <div class="flex items-center gap-5">
            <a href="{{ route('admin.categories') }}">
                <x-icons.arrow-left class="size-4" />
            </a>
            <a href="{{ route('admin.category.product.add', ['category' => $category]) }}" class="py-2 px-4 bg-emerald-500 rounded-lg text-white">افزودن محصول</a>
        </div>


        <div class="flex items-center gap-2 text-sm text-gray-500 my-4">
            <p>{{ $category->parent?->title ?? '-' }}</p>
            <span>/</span>
            <p>{{ $category->title }}</p>
        </div>
        <div class="grid gap-5">
            <div class="flex gap-5">
                <label for="">
                    <span>فعال</span>
                    <input type="checkbox" wire:model.live.debounce="category.active">

                </label>
            </div>
            <div class="flex items-center justify-between gap-5">
                <input type="text" wire:model.live.debounce="category.title" class="w-full">
                <select wire:model.live.debounce="parent_id">
                    <option value="">زیرمجموعه</option>
                    @foreach($this->categories as $cat)
                        <option @disabled($cat->id === $category->id) value="{{ $cat->id }}">{{ $cat->title }}</option>
                    @endforeach
                </select>
            </div>

            <textarea wire:model.live.debounce="category.body" class="w-full min-h-32" x-data x-autosize placeholder="توضیحات..."></textarea>

@if(is_null($category->parent_id))
            <div>
                <div class="grid gap-4">
                    <label for="image">
                        <span class="w-fit rounded-lg bg-gray-200 py-2 px-6" wire:loading.remove wire:target="image">تصویر</span>
                        <span class="w-fit rounded-lg bg-gray-200 py-2 px-6" wire:loading.flex wire:target="image"><x-icons.spin class="size-4 animate-spin" /></span>
                        <input type="file" wire:model.live.debounce="image" class="sr-only" id="image">
                    </label>
                    <img  src="{{ $category->getFirstMediaUrl('category', 'preview') }}" alt="">
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="space-y-2 my-5">
        <p class="border-b pb-2">محصولات این دسته بندی</p>
        <div class="space-y-3 mt-4">
            @foreach($category->products as $product)
                <div wire:key="{{ $product->id }}">
                    <a href="{{ route('admin.product.edit', $product) }}">{{ $product->title }} - {{ $product->category->title }}</a>
                </div>
            @endforeach
        </div>
    </div>
    @role('super')
    <button
        wire:confirm="خطر! دسته بندی و تمام محصولات حذف میشوند.."
        wire:click="dilit" class="text-red-500 fixed  top-20 left-5 outline-none">x</button>
    @endrole
</div>
