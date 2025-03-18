@props([
    'id', 
    'name' => 'Default user', 
    'picture' => 'Placeholder.jpg', 
    'vision' => 'Default Vision', 
    'mission' => 'Default Mission',
])

@if ($id)
    <div {{ $attributes }} class="flex flex-col gap-8 w-full bg-white rounded-lg shadow-sm p-5 poppins-regular">
        <div>
            <img class="rounded-lg w-full"
                src="{{ Vite::asset("resources/assets/images/{$picture}") }}"
                alt="gambar kandidat" draggable="false" />
        </div>
        <div class="flex flex-col gap-6">
            <div class="w-full flex justify-center items-center">
                <h5 class="mb-2 text-2xl poppins-bold tracking-tight text-gray-900">{{ $name }}</h5>
            </div>
            <div class="grid grid-rows-2 mb-3">
                <div class="flex gap-2 font-bold">
                    <x-iconpark-dot class="w-6 h-6" />
                    <span>Visi:</span>
                </div>
                <div class="font-normal text-gray-700">
                    <p class="ml-8">{{ $vision }}</p>
                </div>
            </div>
            <div class="grid grid-rows-2 mb-3">
                <div class="flex gap-2 font-bold">
                    <x-iconpark-dot class="w-6 h-6" />
                    <span>Visi:</span>
                </div>
                <div class="font-normal text-gray-700">
                    <p class="ml-8">{{ $mission ?? 'Default Mission' }}</p>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <a href="" class="w-full flex justify-center items-center gap-2 px-3 py-2 text-md font-medium text-white rounded-lg transition-colors bg-indigo-500 hover:bg-indigo-700">
                <span>
                    <x-feathericon-edit class="w-5 h-5" />
                </span>
                <span>
                    Edit
                </span>
            </a>
            <form action="" method="post">
                <button
                    class="w-full flex justify-center items-center gap-2 px-3 py-2 text-md font-medium text-red-500 hover:text-white hover:bg-red-500 border-2 border-red-500 rounded-lg transition-colors bg-transparent">
                    <span>
                        <x-ionicon-trash-outline class="w-5 h-5" />
                    </span>
                    <span>
                        Delete
                    </span>
                </button>
            </form>
        </div>
    </div>
@endif
