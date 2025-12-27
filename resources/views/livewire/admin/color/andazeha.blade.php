<?php

use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use App\Models\Size;
use App\Models\Variation;
use Livewire\Attributes\Computed;
use  Illuminate\Support\Facades\Validator;

new #[\Livewire\Attributes\On('refresh')] class extends Component {


    public  $variation;


    #[\Livewire\Attributes\Computed]
    public function andazeha()
    {
        return $this->variation->children()
            ->with('stocks')
            ->orderBy('order')->get();
    }


    #[Computed]
    public function sizes()
    {
        return Size::all();
    }


    public function updateSizeOrder($order)
    {
        foreach ($order as $item) {
            Variation::find($item['value'])->update(['order' => $item['order']]);
        }

        $this->js('$wire.$refresh()');
    }

    public function dilitSize(Variation $andaze)
    {
        $andaze->delete();
        $this->js('$wire.$parent.$refresh()');
    }

    public function add_size($title)
    {


        if (in_array($title, $this->variation->children->pluck('title')->toArray())) {
            Validator::make(
                ['title' => $title],
                ['title' => 'unique:variations,title'],
                ['title.unique' => 'قبلا انتخاب شده'],
            )->validate();
        }


        Variation::create([
            'type' => 'size',
            'title' => $title,
            'product_id' => $this->variation->product->id,
            'parent_id' => $this->variation->id
        ]);

        $this->js('$wire.$parent.$refresh()');
    }

}; ?>

<div class="pb-10">
    <p class="text-center py-2 font-bold">اندازه های این رنگ را با کلیک انتخاب کنید</p>

    <div class="w-full">
        <div
            class="w-full text-center  flex flex-row flex-wrap gap-5">
            @foreach($this->sizes as $size)
                <button wire:key="{{$size->id}}" wire:click="add_size('{{ $size->title }}')"
                        class="font-sans py-1 px-3 rounded-lg bg-black text-white">{{ $size->title }}  </button>

            @endforeach
        </div>

        @error('title') <p class="error">{{ $message }}</p> @enderror
    </div>
    <div class="my-10">
        <p class="pb-3">اندازه های انتخاب شده</p>
        <ul wire:sortable="updateSizeOrder" class="grid gap-3 place-items-end">
            @foreach($this->andazeha as $andaze)
                <div wire:sortable.item="{{ $andaze->id }}" wire:key="size-{{ $andaze->id }}"
                     class="flex items-center gap-x-3 py-2 rounded-lg border-black bg-white">
                    <p wire:sortable.handle class="font-sans font-bold">{{ $andaze->title }}
                        ({{$andaze->stockCount() }})</p>
                    <livewire:admin.products.admin-add-stock :andaze="$andaze" :key="$andaze->id"/>
                    <livewire:admin.products.color-size-active :$andaze :key="'andaze-'.$andaze->id"/>
                    <button wire:click="dilitSize({{$andaze}})"
                            class="focus:outline-none text-red-500" wire:confirm>x
                    </button>
                </div>
            @endforeach
        </ul>
    </div>
</div>
