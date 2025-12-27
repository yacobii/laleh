<div class="relative p-1 md:p-10">

    <div x-data="{tab: $wire.idd}" class="flex flex-col md:flex-row items-start md:justify-between">
        @foreach($this->categories as $category)
            <div wire:key="{{ $category->id }}" class="w-full md:space-y-12">
                <button wire:click="set('idd', '{{ $category->id }}')"
                        class="outline-none border-b pb-2 border-gray-300 w-full text-red-500">{{ $category->title }}</button>

                <div wire:show="idd == {{ $category->id }}" x-cloak class="space-y-2 md:space-y-12">
                    <div class="">
                        <p class="py-2">رنگ {{ $category->title }}</p>
                        <div class="flex w-full">
                            <input type="text" wire:model="title" placeholder="رنگ..." class="w-full h-10">
                            <button wire:click="add"
                                    class="text-xl px-5 h-10 focus:outline-none text-white bg-green-500">
                                <span>+</span>
                            </button>
                        </div>
                    </div>
                    <livewire:admin.colors.list :category_id="$category->id" :key="'cat-'.$category->id"/>
                </div>


            </div>
        @endforeach


    </div>

    <x-errors/>

</div>
