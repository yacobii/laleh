<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title># Admin</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/fav/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/fav/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="noindex,nofollow"/>

    <link rel="stylesheet" href="{{ asset('easymde/easymde.min.css') }}">

    <link rel="stylesheet" href="{{ asset('fonts/yekan.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-yekan">
<div class="fixed w-24 text-gray-200 text-xs md:text-base md:w-44  inset-y-0 h-screen md:grid ">
    <header
        class="relative  divide-y divide-dashed h-screen [&>div]:py-1 md:[&>div]:py-2 bg-gray-800 z-[99]   text-center  pt-5 md:pt-10  text-sm">
        <div>
            <x-logo class="size-10 mx-auto my-2"/>
            <p>{{ auth()->user()->name }}</p>
        </div>
        <div class="px-2 {{ Route::is('admin.orders') ? 'bg-green-500 text-black' : '' }}">
            <a href="{{ route('admin.orders') }}">سفارشات</a>

        </div>
<div class="px-2 {{ Route::is('admin.sales') ? 'bg-green-500 text-black' : '' }}">
    <a href="{{ route('admin.sales') }}">آمار</a>
</div>
        <div class="px-2 {{ Route::is('admin.coupons') ? 'bg-green-500 text-black' : '' }}">
            <a href="{{ route('admin.coupons') }}">کوپن</a>
        </div>
        <div class="px-2 {{ Route::is('admin.categories') ? 'bg-green-500 text-black' : '' }}">
            <a href="{{route('admin.categories')}}" wire:navigate>دسته‌بندی</a>
        </div>
        <div class="px-2 {{ Route::is('admin.colors') ? 'bg-green-500 text-black' : '' }}">
            <a href="{{ route('admin.colors') }}" wire:navigate>رنگ</a>
        </div>
        <div class="px-2 {{ Route::is('admin.sizes') ? 'bg-green-500 text-black' : '' }}">
            <a href="{{ route('admin.sizes') }}" wire:navigate>سایز</a>
        </div>
        <div class="px-2 {{ Route::is('admin.products') ? 'bg-green-500 text-black' : '' }} flex items-center justify-between md:justify-center md:gap-4">
            <a class="" href="{{ route('admin.products') }}"
               wire:navigate>محصولات</a>
            @can('super')
                <a href="{{ route('admin.product.add') }}">
                    <x-icons.plus class="size-4 md:size-6"/>
                </a>
            @endcan
        </div>

        @can('super')
            <div class="px-2 {{ Route::is('admin.posts') ? 'bg-green-500 text-black' : '' }}">
                <a href="{{ route('admin.posts') }}">پست‌</a>
            </div>
            <div class="px-2 {{ Route::is('admin.texts') ? 'bg-green-500 text-black' : '' }}">
                <a href="{{ route('admin.texts') }}">متن</a>
            </div>
            <div class="px-2 {{ Route::is('admin.users') ? 'bg-green-500 text-black' : '' }}">
                <a href="{{ route('admin.users') }}">کاربران</a>
            </div>
            <div class="grid gap-5">
                <livewire:admin.credit/>
            </div>
        @endcan
        <div class="grid gap-5">

            <a href="/" target="_blank">سایت</a>
        </div>

        <div class="grid text-center mx-auto">
            <a href="{{ route('admin.logout') }}"
               class="flex justify-center gap-x-2"><span>خروج</span><span>{{ auth()->user()?->name ?? '-' }}</span>
            </a>
        </div>
        <div>
            <p class="text-yellow-300 text-xs pt-2">برخی ویژگی‌ها و امکانات ادمین در این نسخه دمو غیرفعال است.</p>
        </div>
    </header>
</div>

<!-- MOBILE -->


<main class="mr-24 md:mr-44">
    {{ $slot }}
</main>
</body>
</html>
