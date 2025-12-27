<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Statsfa Website Analytics Start -->
    <script data-host="https://statsfa.com" data-dnt="true" src="https://statsfa.com/js/script.js" id="ZwSg9rf6GA" async defer></script>
    <!-- Statsfa Website Analytics End -->
    @isset($seo)
        {{$seo}}
    @endisset

    @empty($seo)
        <title>سایت آماده فروشگاهی پوشاک، کیف و کفش</title>
        <meta name="description" content="سایت آماده فروشگاهی برای فروشندگان اینترنتی پوشاک، کیف و کفش و غیره با طراحی مدرن، سرعت بالا و مسیر خرید ساده. مجهز به مدیریت محصولات و سفارشات، بهینه‌سازی شده برای سئو و مناسب برای رشد برند شما در گوگل."/>
    @endempty

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/fav/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/fav/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/fav/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/fav/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/fav/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/fav/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/fav/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/fav/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/fav/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('/fav/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/fav/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/fav/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/fav/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/fav/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">



    <meta property="og:type" content="website">
    <meta property="og:title" content="#">
    <meta property="og:url" content="#">
    <meta property="og:image" content="#">
    <meta property="og:description" content="# online website">
    <meta property="og:site_name" content="#">
    <meta name="author" content="#">
    <meta name="copyright" content="#">

    <link rel="stylesheet" href="{{ asset('fonts/yekan.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body x-data class="font-yekan scroll-smooth bg-white mx-auto w-full ">

<div class="flex flex-col mx-auto min-h-dvh">
    <x-header/>
    <main class="w-full flex-1 py-14">
        {{ $slot }}
    </main>
    <x-footer/>
</div>


</body>
</html>
