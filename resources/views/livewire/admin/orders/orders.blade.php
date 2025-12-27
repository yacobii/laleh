<div class="p-1 md:p-10">
    <div class="">
        <label for="">
            <input type="search" wire:model.live.debounce="term" class="w-full h-10" placeholder="نام یا موبایل...">
        </label>
    </div>


    <div class="py-3">
        <div class="space-y-4">
            @forelse($this->orders as $order)
                <div class="border rounded-lg relative text-sm md:text-base" wire:key="{{ $order->id }}">

                    <div class="flex flex-col md:flex-row items-center gap-4 py-2 px-3">
                        <div class="w-full flex items-center justify-between md:justify-start md:gap-2">
                            <p class="text-xl  text-left text-red-500">{{ $order->code }}</p>
                            <p>{{ $order->user->name }}</p>
                            <p>{{ $order->user->mobile }}</p>
                        </div>
                        <div class="flex gap-4">
                            <p class="flex items-center gap-1">{{ number_format($order->total ?? 0) }} <span class="text-xs">ریال</span></p>
                            <p class="ml-auto text-sm text-gray-600 flex items-center gap-1">منبع: <strong
                                    class="text-sm">{{ $order->refer ?? 'internal' }}</strong>
                            </p>
                        </div>
                    </div>
                    <p class="px-3">{{ $order->user->address }}</p>


                    <livewire:admin.orders.items :$order :key="$order->id" />
                    <div class="flex flex-col md:flex-row gap-5 items-center">

                        <livewire:admin.orders.status-change :$order :key="$order->id"/>
                        <span class="hidden md:block">|</span>
                        <p>اطلاعات پرداخت</p>
                    </div>
                </div>
            @empty
                <div class="">
                    <p>هیچ سفارشی ثبت نشده</p>
                </div>
            @endforelse
        </div>

    </div>


    <div class="">
        {{ $this->orders->links('vendor.pagination.tailwind') }}
    </div>
</div>
