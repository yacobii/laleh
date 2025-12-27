<div class="pb-20 space-y-4">

    <div class="">
        <img class="w-32" src="{{ $feature->getFirstMediaUrl('features', 'preview') }}" alt="">
    </div>
    <div>
        <input type="text" wire:model.live="feature.title" class="w-full">
    </div>
    <div>
        <input type="file" wire:model="image">
    </div>



</div>
