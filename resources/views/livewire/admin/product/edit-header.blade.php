<div>
    <div class="py-2 px-5 bg-gray-500 text-white flex items-center gap-x-4">
        <div class="w-full flex flex-col items-start gap-2">
            <div class="flex gap-x-2 items-center text-sm">
                <p>این محصول</p>
                <button
                    @class([
    'py-1 px-3 rounded-lg bg-red-500 text-white' => !$product->active,
    'py-1 px-3 rounded-lg bg-emerald-500 text-white' => $product->active,
    ])
                    wire:click="$toggle('product.active')">
                    <span x-show="$wire.product.active === true">موجود</span>
                    <span x-show="$wire.product.active === false">نامجود</span>
                </button>
                <p>است</p>
            </div>
            <div class="flex items-center gap-1">
                <p>{{ $product->name }}</p>
            </div>
        </div>

    </div>
    <div class="flex items-center justify-between p-2 md:p-5 text-center">

        <a
            @class([
            'border-gray-300 focus:outline-none w-full pb-2 border-b-2',
            'border-green-500' => Route::currentRouteName() === 'admin.product.edit',
    ])
            href="{{ route('admin.product.edit', $product) }}">
            <span>اطلاعات</span>
        </a>

        <a
            @class([
            'border-gray-300 focus:outline-none w-full pb-2 border-b-2',
            'border-green-500' => Route::is('product.sizes'),
    ])
            href="{{ route('product.sizes', $product) }}">
            <span>سایز</span>
        </a>

        <a
            @class([
            'border-gray-300 focus:outline-none w-full pb-2 border-b-2',
            'border-green-500' => Route::currentRouteName() === 'product.colors',
    ])
            href="{{ route('product.colors', $product) }}">
            <span>رنگ</span>
        </a>

        <a
            @class([
            'border-gray-300 focus:outline-none w-full pb-2 border-b-2',
            'border-green-500' => Route::is('product.gallery'),
    ])
            href="{{ route('product.gallery', $product) }}">
            <span>گالری</span>
        </a>

        <a
            @class([
            'border-gray-300 focus:outline-none w-full pb-2 border-b-2',
            'border-green-500' => Route::is('product.ai'),
    ])
            href="{{ route('product.ai', $product) }}">
            <span>AI</span>
        </a>

    </div>
</div>

