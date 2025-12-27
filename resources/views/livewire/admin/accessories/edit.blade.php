<div class="py-10" >
    <div class="space-y-6">
        <label for="" class="block">
            <input type="text" wire:model.live="accessory.name" class="w-full">
        </label>
        <label for="" class="block">
            <input type="text" wire:model.live="accessory.price" class="w-full font-sans">
        </label>
        <label for="" class="block">
            <textarea class="w-full h-32" wire:model.live="accessory.description"></textarea>
        </label>
        <label for="" class="block space-y-3">
            <div>
                <img class="w-32 object-cover" src="{{ $accessory->getFirstMediaUrl('accessories', 'preview') }}" alt="">
            </div>
            <input type="file" wire:model="image" class="w-full font-sans">
        </label>
    </div>
</div>
