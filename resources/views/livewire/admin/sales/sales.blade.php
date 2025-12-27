<div class="">

    <div class="sticky top-10 py-3 shadow px-3 z-50 bg-white">
        <x-admin.order-sub/>
    </div>
    <div class="p-10 divide-y divide-dashed divide-gray-400">
        @foreach($this->sales as $sale)
            <div class="py-1 flex items-center justify-center gap-10 ">
                <p>{{ number_format($sale['daily_total']) }} تومان</p>
                <p>{{ verta($sale['date'])->format('Y/m/d') }}</p>
            </div>
        @endforeach
    </div>


</div>

