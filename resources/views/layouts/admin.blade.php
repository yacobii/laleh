<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>
    <meta name="robots" content="noindex,nofollow">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fav/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/favicon-16x16.png') }}">
    <link rel="preload" href="{{ asset('fonts/shabnam/Shabnam-Bold-FD.woff2') }}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/shabnam/Shabnam-FD.woff2') }}" as="font" type="font/woff2"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fonts/shabnam/shabnam.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-shabnam scroll-smooth">

<div class="flex flex-col min-h-dvh">
    <header class="py-5 px-10 flex items-center gap-10 sticky top-0 bg-gray-200 z-50">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.posts') }}">posts</a>
        </div>
        <span>|</span>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.portfolios') }}">portfolios</a>
        </div>
        <span>|</span>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.texts') }}">texts</a>
        </div>
        <span>|</span>
        <a href="{{ route('admin.eghrtedar.posts') }}" target="_blank">Eghtedar Posts</a>
        <span>|</span>
        <a href="/" target="_blank">site</a>
        <span>|</span>
    </header>
    <main class="container mx-auto grow py-5">
        {{ $slot }}
    </main>


</div>
</body>
</html>
