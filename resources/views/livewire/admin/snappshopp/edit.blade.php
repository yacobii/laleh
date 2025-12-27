<div class="p-6 space-y-4">
    @if (session()->has('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="text-red-600">{{ session('error') }}</div>
    @endif

    <div>
        <p class="text-sm">{{ verta($date)->format('d F l Y') }}</p>
        <p>{{ $title }}</p>
        <img src="{{ $thumbnail }}" alt="">
    </div>

        <div>
            <label>sku:</label>
            <input type="text" wire:model="sku" class="border p-2 w-full">
        </div>

        <div>
            <label>موجودی:</label>
            <input type="text" wire:model="stock" class="border p-2 w-full">
        </div>

    <div>
        <label>قیمت تومان:</label>
        <input type="number" wire:model="price" class="border p-2 w-full">
    </div>



    <div class="space-y-2">
        <h3 class="font-bold">ویژگی‌ها:</h3>
        @foreach($attribs as $index => $attr)
            <div class="flex gap-2">
                <div>{{ $attr['attribute']['title'] ?? '' }}</div>
                <div>{{ $attr['value']['title'] ?? '' }}</div>
            </div>
        @endforeach

    </div>

    <button wire:click="update" class="bg-blue-500 text-white px-4 py-2 rounded">بروزرسانی</button>

    <div>
        <a href="{{ route('admin.snappshopp') }}" class="flex gap-2">
            <span>بازگشت</span>
            <x-icons.left class="size-4" />
        </a>
    </div>
</div>
