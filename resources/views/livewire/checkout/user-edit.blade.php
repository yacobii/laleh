<div>
    <div class="bg-gray-200 text-black p-3 rounded-lg">
        <p class="mb-2">سفارش به گیرنده و نشانی زیر ارسال خواهد شد.</p>

        <div class="divide-y divide-dashed divide-black">
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">نام و نام خانوادگی:</p>
                <p>{{ $user->name ?? null }}</p></div>
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">موبایل:</p>
                <p>{{ $user->mobile }}</p></div>
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">آدرس:</p>
                <p>{{ $user->address ?? null }}</p>
            </div>
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">شهر:</p>
                <p>{{ $user->city ?? 'تکمیل شود' }}</p>
            </div>
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">کدپستی:</p>
                <p>{{ $user->postal ?? null }}</p></div>
            <div class="flex items-center gap-x-3 py-2">
                <p class="font-bold">کدملی:</p>
                <p>{{ $user->melli ?? 'درج شود' }}</p></div>
        </div>

        <div class="pt-3">
            <button wire:click="$set('show_edit', true)"
                    class="p-2 text-xs focus:outline-none bg-emerald-500 hover:bg-emerald-400 text-white rounded-lg">
                ویرایش اطلاعات
            </button>
        </div>
    </div>

    @if($show_edit)
        <livewire:checkout-edit-address  :$user />
    @endif
</div>
