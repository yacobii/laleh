<div class="p-6 space-y-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <div class="flex gap-4">
        <h3>آمار فروش</h3>

        <div class="flex items-center gap-4">
            <select wire:model.live="selectedPeriod">
                <option value="today">امروز</option>
                <option value="yesterday">دیروز</option>
                <option value="week">این هفته</option>
                <option value="month">این ماه</option>
                <option value="custom">تاریخ سفارشی</option>
            </select>

            @if($selectedPeriod === 'custom')
                <div class="flex items-center gap-2">
                    <span>از</span>
                    <flux:input
                        type="text"
                        wire:model.live="fromDate"
                        placeholder="مثال: 1402/01/01"
                        dir="ltr"
                        class="text-center"
                    />
                    <span>تا</span>
                    <flux:input
                        type="text"
                        wire:model.live="toDate"
                        placeholder="مثال: 1402/12/29"
                        dir="ltr"
                        class="text-center"
                    />
                </div>
            @endif

        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="p-6 bg-gray-50 rounded-lg dark:bg-gray-700">
            <h3 class="text-lg font-semibold mb-4">
                <span>جمع کل فروش</span>

    <span>{{ match($selectedPeriod) {
        'today' => 'امروز',
        'yesterday' => 'دیروز',
        'week' => 'این هفته',
        'month' => 'این ماه',
        'custom' => 'سفارشی',
        default => ''
    } }}</span>
            </h3>
            <p class="text-3xl font-bold">
                {{ number_format($analytics['total_sales'], 2) }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                {{ $analytics['date_range']['start']['persian'] }} تا {{ $analytics['date_range']['end']['persian'] }}
            </p>
        </div>

        <div class="p-6 bg-gray-50 rounded-lg dark:bg-gray-700">
            <h3 class="text-lg font-semibold mb-4">پرفروشترین</h3>
            <div class="space-y-4">
                @foreach($analytics['top_products'] as $product)
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $product->product->title }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <span>تعداد:</span> <span>{{ $product->total_quantity }}</span>
                            </p>
                        </div>
                        <p class="font-semibold">
                            {{ number_format($product->total_revenue, 2) }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
