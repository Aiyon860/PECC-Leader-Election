<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Favicon -->
        @php
            $faviconPath = Vite::asset("resources/assets/favicon/");
        @endphp
        <link rel="apple-touch-icon" sizes="180x180" href="{{ $faviconPath }}/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconPath }}/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ $faviconPath }}/favicon-16x16.png">
        <link rel="manifest" href="{{ $faviconPath }}/site.webmanifest">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="poppins-regular antialiased bg-gray-100">
        <div class="min-h-screen w-full">
            <!-- Page Content -->
            <x-navbar-admin>
                {{ $slot }}
            </x-navbar-admin>
        </div>
    </body>
</html>