<div>
    <div class="p-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <div class="divide-y divide-gray-400">
                @forelse($this->accessories as $accessory)
                    <div class="py-4 flex items-center gap-x-3">
                        <button wire:click="dilit({{$accessory->id}})" class="focus:outline-none text-red-500">x
                        </button>
                        <p><img class="w-20" src="{{ $accessory->getFirstMediaUrl('accessories', 'preview') }}" alt=""></p>
                        <div><button class="focus:outline-none" wire:click="$set('accessoryID', {{ $accessory->id }})">{{ $accessory->name  }} - {{ $accessory->price }}</button></div>
                    </div>
                @empty
                    <p>No Accessory</p>
                @endforelse

                @if($accessoryID)
                    <livewire:admin.accessories.edit :accessoryID="$accessoryID" wire:key="{{ $accessoryID }}" />
                @endif
            </div>

            <div class="space-y-6">
                <div>
                    <p>نام</p>
                    <label for="name">
                        <input type="text" id="name" wire:model="name" class="block w-full" placeholder="نام">
                    </label>
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <p>توضیحات</p>
                    <label for="description">
                        <textarea id="description" class="block w-full h-32" wire:model="description" placeholder="توضیحات"></textarea>
                    </label>

                </div>

                <div>
                    <p>قیمت</p>
                    <input type="text" wire:model="price" number class="block w-full font-sans" placeholder="قیمت">
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                </div>

                <input type="file" class="" wire:model.live="image">
                @if($image)
                    <img class="w-32" src="{{ $image->temporaryUrl() }}" alt="">
                @endif
                <div class="text-left">
                    <button class="focus:outline-none bg-green-500 py-1 px-4 rounded-lg text-white" wire:click="add">ثبت
                        اکسسوری
                    </button>
                </div>
            </div>
        </div>


    </div>
</div>
