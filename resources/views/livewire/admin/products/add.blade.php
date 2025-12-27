<div>
    <div class="p-1 md:p-10">

        <form wire:submit="save" class="space-y-8">

            <div class="flex flex-col md:flex-row items-center gap-1 md:gap-4 w-full">
                <div class="w-full">
                    <input type="text" id="name" wire:model="title"
                           class="w-full block placeholder:text-sm placeholder:text-gray-300" placeholder="عنوان محصول ...">
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>
                <select name="" id="" wire:model.live.debounce="selected" class="w-full">
                    <option value="">دسته بندی</option>
                    @foreach($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @if($this->children)
                    <select wire:model.live="child_id" class="w-full">
                        <option value="">زیرگروه</option>
                        @foreach($this->children as $child)
                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
            <selction class="space-y-2 md:space-y-6">


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
