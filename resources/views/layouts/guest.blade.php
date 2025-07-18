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
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="poppins-regular text-gray-900 antialiased">
        <div class="grid lg:grid-cols-2 min-h-screen bg-gray-100">
            <div class="left-side-login grid pt-6 sm:pt-0">
                <div class="flex gap-4 p-8 justify-center lg:justify-start">
                    <x-pecc-logo/>
                    <x-polines-logo/>
                </div>

                <div class="flex flex-col sm:justify-center items-center">
                    <div class="w-5/6 sm:max-w-md my-6 px-6 py-4 bg-white shadow overflow-hidden rounded-2xl">
                        {{ $slot }}
                    </div>
                </div>

                <div class="poppins-semibold text-xs flex flex-col justify-center lg:justify-end items-center lg:items-start mt-8 lg:mt-0 p-4 lg:p-8 bg-[#F59E0B] lg:bg-transparent">
                    <p class="text-wrap text-center">2025 © all right reserved. Polytechnic English Conversation Club</p>
                </div>
            </div>
            <div class="hidden lg:block right-side-login">
                <div class="h-screen w-full bg-[url('../assets/svgs/vote-image-login-with-gradient-bg.svg')] bg-cover bg-center rounded-tl-3xl rounded-bl-3xl">
                </div>
            </div>
        </div>
    </body>
</html>
