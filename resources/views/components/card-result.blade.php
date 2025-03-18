@props([
    'id', 
    'name' => 'Default user', 
    'picture' => 'Placeholder.jpg', 
])

@if ($id)
    <div {{ $attributes }} class="flex flex-col gap-8 w-full bg-white rounded-lg shadow-sm p-5 poppins-regular">
        <div>
            <img class="rounded-lg w-full"
                src="{{ Vite::asset("resources/assets/images/{$picture}") }}"
                alt="gambar kandidat" draggable="false" />
        </div>
        <div class="p-6 flex flex-col justify-center items-center gap-4 border-2 border-gray-200 rounded-lg">
            <h5 class="text-3xl poppins-regular tracking-tight text-gray-900">{{ $name }}</h5>
            <div class="poppins-semibold text-5xl">
                25 votes
            </div>
        </div>
    </div>
@endif
