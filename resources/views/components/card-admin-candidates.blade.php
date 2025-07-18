@props([
    'id', 
    'name' => 'Default user', 
    'picture' => 'Placeholder.jpg', 
    'vision' => 'Default Vision', 
    'mission' => 'Default Mission',
])

@if ($id)
    <div {{ $attributes }} class="flex flex-col gap-8 w-full bg-white rounded-lg shadow-sm p-5 poppins-regular" x-data="{ name: '{{ $name }}' }">
        <div>
            <img class="rounded-lg w-full object-cover lg:h-[30rem] xl:h-[50rem]"
                src="{{ asset('storage/' . $picture) }}"
                alt="Kandidat {{ $name }}" draggable="false" />
        </div>
        <div class="flex flex-col gap-6">
            <div class="hidden pointer-events-none" x-text="{{ $id }}"></div>
            <div class="w-full flex justify-center items-center">
                <h5 class="mb-2 text-2xl poppins-bold tracking-tight text-gray-900">{{ $name }}</h5>
            </div>
            <div class="flex flex-col mb-3">
                <div class="flex gap-2 font-bold">
                    <x-iconpark-dot class="w-6 h-6" />
                    <span>Visi:</span>
                </div>
                <div class="font-normal text-gray-700">
                    <p class="ml-8">{{ $vision }}</p>
                </div>
            </div>
            <div class="flex flex-col mb-3">
                <div class="flex gap-2 font-bold">
                    <x-iconpark-dot class="w-6 h-6" />
                    <span>Misi:</span>
                </div>
                @php
                    $text = $mission;
                    
                    // Split the text by numbers followed by a period and space
                    $items = preg_split('/(\d+\.\s)/', $text, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
                    
                    // Group the items properly (number with its content)
                    $formattedItems = [];
                    for ($i = 0; $i < count($items); $i += 2) {
                        if (isset($items[$i+1])) {
                            $formattedItems[] = $items[$i] . $items[$i+1];
                        }
                    }
                @endphp
                <div class="font-normal text-gray-700">
                    <ul class="ml-8">
                        @foreach ($formattedItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <a href="{{ route("candidate.edit", $id) }}" class="w-full flex justify-center items-center gap-2 px-3 py-2 text-md font-medium text-white rounded-lg transition-colors bg-indigo-500 hover:bg-indigo-700">
                <span>
                    <x-feathericon-edit class="w-5 h-5" />
                </span>
                <span>
                    Edit
                </span>
            </a>
            <form action="{{ route("candidate.destroy", $id) }}" method="post">
                @csrf
                @method('DELETE')
                <button
                    @click="$dispatch('open-modal', 'confirmation-modal-{{ $id }}')"
                    type="button"
                    class="w-full flex justify-center items-center gap-2 px-3 py-2 text-md font-medium text-red-500 hover:text-white hover:bg-red-500 border-2 border-red-500 rounded-lg transition-colors bg-transparent">
                    <span>
                        <x-ionicon-trash-outline class="w-5 h-5" />
                    </span>
                    <span>
                        Delete
                    </span>
                </button>
                <x-modal name="confirmation-modal-{{ $id }}">
                    <div class="flex justify-between p-6">
                        <h2 class="poppins-semibold text-xl">Confirm Candidate Deletion</h2>
                        <button @click="$dispatch('close-modal', 'confirmation-modal-{{ $id }}')" type="button"
                            class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                            <x-eos-close class="w-5 h-5" />
                        </button>
                    </div>
                    <hr>
                    <div class="flex justify-between p-6">
                        <p class="poppins-regular text-md">Are you sure you want to delete <span x-text="name"></span> from the ballot? This action cannot be undone and will remove all associated votes.</p>
                    </div>
                    <hr>
                    <div class="flex justify-end gap-2 p-6 poppins-regular">
                        <button type="button" @click="$dispatch('close-modal', 'confirmation-modal-{{ $id }}')"
                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancel
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-full font-medium text-sm text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Delete Candidate
                        </button>
                    </div>
                </x-modal>
            </form>
        </div>
    </div>
@endif
