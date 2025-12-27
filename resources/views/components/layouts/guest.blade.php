<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fav/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fav/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('fav/site.webmanifest') }}">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">

        <title>#</title>
        <link rel="stylesheet" href="{{ asset('fonts/yekan.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class=" bg-white mx-auto w-full font-yekan">

            <div class="w-full  mx-auto">
                {{ $slot }}
            </div>
    </body>
</html>
