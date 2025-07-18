@props([
    'id',
    'name' => 'Default user', 
    'picture' => 'Placeholder.jpg',
    'totalVotes' => 0,
])

@if ($id)
    <div {{ $attributes }} class="flex flex-col gap-8 w-full bg-white rounded-lg shadow-sm p-5 poppins-regular">
        <div>
            <img class="rounded-lg w-full lg:h-[30rem] xl:h-[50rem] object-cover"
                src="{{ asset('storage/' . $picture) }}"
                alt="gambar kandidat" draggable="false" />
        </div>
        <div class="p-6 flex flex-col justify-center items-center gap-4 border-2 border-gray-200 rounded-lg">
            <h5 class="text-xl md:text-2xl xl:text-3xl poppins-regular tracking-tight text-gray-900">{{ $name }}</h5>
            <div class="poppins-semibold text-2xl md:text-3xl xl:text-4xl">
                {{ $totalVotes }} <span>{{ $totalVotes == 1 ? 'vote' : 'votes' }}</span>
            </div>
        </div>
    </div>
@endif
