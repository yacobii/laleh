<div class="rtl">
    <div class="sticky top-12 py-3 shadow px-3 z-50 bg-white">
        <label for="">
            <input type="search" wire:model.live.debounce="term" class="w-full h-10" placeholder="نام یا موبایل...">
        </label>
        <x-admin.order-sub/>
    </div>


    <div class="p-3">
        <div class="divide-y divide-gray-400 my-10 border-y border-gray-400">
            @foreach($this->orders as $order)
                <div class="border-x border-gray-400 p-2 hover:bg-slate-200" id="{{ $order->id }}" wire:key="{{ $order->id }}">
                    <a href="{{ route('admin.order', $order) }}" class="">
                        <div class="w-full flex items-center justify-between">
                            <div>
                                <p> کدسفارش: {{ $order->code }}</p>
                                <p class="text-sm">{{ verta($order->created_at)->format('l d F Y - H:i:s') }}</p>
                            </div>
                            <div>
                                <p>{{ $order->user->name }} @can('super') - [{{ $order->id }}]@endcan</p>
                                <div x-data="{ msg:'' }">
                                    <button type="button"
                                            @click="$clipboard('{{ $order->user->mobile }}'); msg = 'Copied'">
                                        {{ $order->user->mobile }} <span class="text-green-500" x-text="msg"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <p class="text-xl"> {{ number_format($order->sum() ) }}
                                <span>تومان</span></p>
                        </div>

                        <div class="flex items-center gap-1">
                            <p>{{ $order->paymented }}</p>
                            <span>-</span>
                            <p>{{ $order->status }}</p>
                            <span>-</span>
                            <p>{{ $order->payment_status == 1 ? 'موفق' : 'ناموفق' }}</p>
                        </div>
                    </a>
                    <div>
                        <p class="text-red-500">{{ $order->description ?? null }}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="">
        {{ $this->orders->links('vendor.pagination.tailwind') }}
    </div>

</div>
