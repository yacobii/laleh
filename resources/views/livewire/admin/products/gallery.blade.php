<div class="grid gap-4 md:gap-12">
    <livewire:admin.product.edit-header :product="$product"/>


    <div class="p-3 md:p-10 space-y-4 md:space-y-20">
        <div>
            <label for="images">
                <p class="py-3 w-fit rounded-lg px-6 bg-gray-200 hover:bg-gray-300" wire:loading.remove
                   wire:target="images">آپلود تصاویر</p>
                <p class="py-3 w-fit rounded-lg px-6 bg-gray-200" wire:loading wire:target="images">
                    <x-icons.spin class="size-4 animate-spin"/>
                </p>
                <input type="file" wire:model.live.debounce="images" multiple class="sr-only" id="images">
            </label>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4" wire:sortable="updateOrder">
            @foreach($product->getMedia('*') as $media)
                <div class="relative border" wire:sortable.item="{{ $media->id }}" wire:key="media-{{ $media->id }}">
                    <img class="w-full object-cover" wire:sortable.handle src="{{ $media->getUrl('preview') }}" alt="">
                    <button wire:click="dilit({{ $media->id }})"
                            wire:confirm="تصویر حذف شود؟"
                            class="absolute text-red-500 outline-none top-2 left-2"
                    >x
                    </button>
                </div>
            @endforeach
        </div>
    </div>


</div>
