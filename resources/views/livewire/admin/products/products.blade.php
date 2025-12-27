<div class="p-1  md:p-10 relative text-sm">


    <div class=" md:space-y-6" wire:sortable="updateProductOrder">
        <div class="mb-3 sticky top-0 bg-white z-50">
            <input type="search" class="w-full h-8" wire:model.live.debounce="term" placeholder="جستجو نام کالا ...">
        </div>

        <div class="w-full flex flex-col md:flex-row items-start justify-center md:justify-between ">
            @foreach($this->categories as $category)
                <div class="w-full" wire:key="{{ $category->id }}">
                    <button
                        class="w-full text-center border-b py-1 md:py-2 {{ $category->id === $category_id ? 'border-green-500 border-b-2 text-green-500' : '' }}"
                        wire:click="set('category_id', {{ $category->id }})">{{ $category->title }}</button>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5" wire:sortable="updateProductOrder">
            @foreach($this->products as $product)
                <div wire:sortable.item="{{ $product->id }}" class="border relative p-2 grid md:gap-3 place-items-start py-2 md:py-6"
                     wire:key="{{ $product->id }}">
                    <div class="flex flex-col md:flex-row justify-start  gap-4">
                        <div class="grid gap-5">
                            <div class="flex gap-2">
                                <p wire:sortable.handle><span>ترتیب</span> <span>[{{ $product->order }}]</span></p>
                                <p>({{$product->id}})</p>
                                <button
                                    wire:confirm="مطمئن هستید! تمام اطلاعات حذف و غیر قابل برگشت هستند."
                                    wire:click="dilitProduct('{{$product->id}}')"
                                    class="text-red-500 focus:outline-none">
                                    <x-icons.x-mark class="size-4"/>
                                </button>
                            </div>

                            <div class="grid gap-1">
                                <a href="{{ route('admin.product.edit', $product) }}">
                                    <p class="hover:underline font-bold underline-offset-8">{{ $product->title }}</p>
                                </a>
                                <div class="flex gap-2">
                                    <p class="text-sm {{ $product->active ? 'text-green-500' : 'text-red-500' }}">{{ $product->active ? 'موجود' : 'ناموجود' }}</p>
                                    @can('super')
                                        <livewire:admin.products.toggle-active :$product :key="$product->id"/>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        {{--                        <livewire:admin.products.takhfif :$product :key="$product->id"/>--}}
                    </div>
                    <p class="text-xs text-green-500">{{ $product->discounted ? '%'.$product->rate : 'بدون تخفیف' }}</p>
                    <p class="text-sm">دسته بندی
                        : {{ $product->category->parent->title }} / {{ $product->category->title }} </p>
                    <div class="flex flex-wrap gap-1">
                        <p>رنگها:</p>
                        @forelse($product->colors as $pc)
                            <div wire:key="{{ $pc->id }}">
                                <p>{{ $pc->title }} <span>{{ !$loop->last ? '-' : '' }}</span> </p>
                            </div>
                        @empty
                            <a class="text-red-500" href="{{ route('product.colors', $product) }}">تعیین رنگ</a>
                        @endforelse
                    </div>
                    <div class="flex flex-wrap gap-1">
                        <p>سایزها:</p>
                        @forelse($product->sizes as $ps)
                           <div wire:key="{{ $ps->id }}">
                               <p>{{ $ps->title }} <span>{{ !$loop->last ? '-' : '' }}</span> </p>
                           </div>
                        @empty
                            <a class="text-red-500" href="{{ route('product.sizes', $product) }}">تعیین سایز</a>
                        @endforelse
                    </div>

                    <!-- images -->
                    <a href="{{ route('product.gallery', $product) }}" class="hidden md:block absolute left-0  h-full   overflow-y-auto">
                        @foreach($product->getMedia('*') as $media)
                            <div class="p-1" wire:key="{{ $media->id }}">
                                <img class="aspect-square size-10 object-cover" src="{{ $media->getUrl('preview') }}" alt="">
                            </div>
                        @endforeach
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    @if($this->products->hasMorePages())
        <div x-data x-intersect="$wire.loadMore()">
            loading ...
        </div>
    @endif
</div>
