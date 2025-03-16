<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PECC Leader Election 2025</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full ">
    {{-- <x-slot:isAdmin>{{ $isAdmin }}</x-slot:isAdmin> --}}
    {{-- @if ($isAdmin)
        <aside>
            <nav>
                mboh
            </nav>
        </aside>
    @endif --}}
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
