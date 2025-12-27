<div>
    <div class="p-10">
        <p class="mb-10 flex gap-1">
            <span>ایجاد محصول جدید برای دسته بندی</span>
            <span>{{ $category->parent->title }}</span>
            <span>{{ $category->title }}</span>
        </p>
        <form wire:submit="save" class="space-y-8">

            <selction class="space-y-6">
                <div class="flex gap-5">
                    <div class="w-full">
                        <label for="name"></label>
                        <input type="text" id="name" wire:model="title"
                               class="w-full block placeholder:text-sm placeholder:text-gray-300" placeholder="عنوان محصول ...">
                        @error('name') <p class="error">{{ $message }}</p> @enderror
                    </div>

                </div>

                <div>
                    <label for="price"></label>
                    <input type="number" id="price" wire:model.blur="price"
                           class="w-full block placeholder:text-sm font-sans placeholder:text-gray-300"
                           placeholder="قیمت به تومان ...">
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                    <p class="text-sm pt-1 flex gap-x-1"><span>{{ number_format($price) }}</span><span>تومان</span></p>
                </div>
                <div>
                    <label for="description">
                        <textarea id="description" wire:model="body" placeholder="توضیحات..."
                                  class="w-full h-40 placeholder:text-sm placeholder:text-gray-300"></textarea>
                    </label>
                    @error('description') <p class="error">{{ $message }}</p> @enderror

                </div>
            </selction>
            <div class="text-left">
                <button class="bg-green-500 text-white rounded-lg py-1 px-3 focus:outline-none text-sm">
                    <span>ایجاد محصول جدید</span>
                </button>
            </div>
        </form>
    </div>
    <x-errors />
</div>
