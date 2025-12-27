<div class="relative">
    <livewire:admin.product.edit-header :product="$product"/>

    <div class="space-y-6 p-5">

        <div class="space-y-2 flex items-center gap-4">
                <div>
                    <p>{{ $product->category->parent->title }} / {{ $product->category->title }}</p>
                </div>
            <div class="flex items-center gap-4 shrink-0">
                <select  wire:model.live.debounce="selected" class="w-full">
                    <option value="" selected>دسته بندی</option>
                    @foreach($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                @if($this->children)
                    <select wire:model.live="product.category_id" class="w-full">
                        <option value="" selected>زیرگروه</option>
                        @foreach($this->children as $child)
                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
<div class="flex flex-col md:flex-row justify-between gap-4">
    <div class="w-full">
        <p>نام</p>
        <input type="text" wire:model.live.debounce="product.title" class="w-full">
            @error('product.title') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div class="w-full">
        <div class="flex items-center justify-between gap-1 text-xs md:text-base">
           <p> <span>قیمت (تومان)</span><span>{{ number_format($product->price) }}</span></p>
            @if(!is_null($product->discount_rate))
               <p> <span>با تخفیف (تومان)</span><span>{{ number_format($product->product_with_discount()) }}</span></p>
            @endif
        </div>
        <input type="text" wire:model.live.debounce="product.price" class="w-full" id="price">
        @error('product.price')<p class="error">{{ $message }}</p>@enderror
    </div>
    <div class="w-full ">
        <p class="flex items-center gap-1"> <span>تخفیف</span><span>{{ number_format($product->discount_rate) }}</span></p>
<div class="relative w-full">
    <input type="text" wire:model.live.debounce="product.discount_rate" class="w-full" id="price">
    <button class="absolute top-3 left-3" wire:click="set('product.discount_rate', null)">x</button>
</div>
        @error('product.discount_rate')<p class="error">{{ $message }}</p>@enderror
    </div>
</div>

        <div>
            <textarea wire:model.live.debounce="product.body" class="w-full field-sizing-content"></textarea>
        </div>

    </div>

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    @endif

</div>
