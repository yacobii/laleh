<div class="space-y-4 my-5 p-5">
    <div>
        <a href="{{ route('admin.products.colors', $variation->product_id) }}" wire:navigate class="w-fit flex gap-6">
            <x-heroicon-o-arrow-left class="size-4"/>
            <span>بازگشت</span>
            </a>
    </div>
    <div class="">
        <div class="w-full">
            <div class="flex gap-1">
                <input type="text" wire:model.live.debounce="variation.title" class="w-full">
                <input type="text" wire:model.live.debounce="variation.code" class="w-full ltr font-sans">
                <input type="text" wire:model.live.debounce="variation.sku" class="w-full block ltr font-sans" placeholder="sku">
            </div>
        </div>

        <div class="w-fit my-3">
            <label for="images" class="w-fit">
                <p wire:loading.remove wire:target="images" class="w-fit py-2 px-6 bg-gray-300 rounded-lg">افزودن تصاویر</p>
                <p wire:loading wire:target="images" class="w-fit py-2 px-6 bg-gray-300 rounded-lg">صبرکنید</p>
                <input type="file" id="images" class="sr-only" multiple wire:model="images">
            </label>
        </div>
    </div>
    <div class="">

        <ul wire:sortable="updateImageOrder" class="grid grid-cols-3 md:grid-cols-6 gap-4">
            @foreach ($variation->getMedia('colors') as $media)
                <li wire:sortable.item="{{ $media->id }}" wire:key="task-{{ $media->id }}" class="relative">
                    <img   wire:sortable.handle class=" object-cover border" src="{{ $media->getUrl('preview') }}" alt="">
                    <button wire:click.prevent="dilitImage({{$media->id}})"
                            class="focus:outline-none p-1 bg-red-500 absolute top-0 left-0 text-white text-sm">x
                    </button>
{{--                    <p class="absolute bottom-0 right-0 w-5 h-5 bg-black text-white grid place-items-center">{{ $media->order_column }}</p>--}}
                </li>
            @endforeach
        </ul>


    </div>


    <div>
        <livewire:admin.color.andazeha  :$variation  />
    </div>

</div>
