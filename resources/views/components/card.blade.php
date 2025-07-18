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
            <img class="rounded-lg w-full lg:h-[30rem] xl:h-[50rem] object-cover"
                src="{{ asset('storage/' . $picture) }}"
                alt="gambar kandidat" draggable="false" />
        </div>
        <div class="flex flex-col gap-6">
            <div class="w-full flex justify-center items-center">
                <h5 class="mb-2 text-2xl poppins-bold tracking-tight text-gray-900">{{ $name }}</h5>
            </div>
            {{-- <div class="grid grid-rows-2 mb-3">
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
            </div> --}}
        </div>
        <div>
            <button @click="let wasSelected = selectedCard === {{ $id }};
            selectedCard = wasSelected ? null : {{ $id }};
            selectedName = wasSelected ? null : '{{ $name }}';"
                x-bind:class="selectedCard === {{ $id }} ? 'bg-red-600 hover:bg-red-700' : 'bg-blue-600 hover:bg-blue-700'"
                class="w-full flex justify-center items-center gap-2 px-3 py-2 text-md font-medium text-white bg-gradient-to-r rounded-lg transition-colors">
                <span x-show="selectedCard === {{ $id }}">
                    <x-eos-cancel class="w-5 h-5" />
                </span>
                <span x-show="selectedCard !== {{ $id }}">
                    <x-bi-check-circle-fill class="w-4 h-4" />
                </span>
                <span x-text="selectedCard === {{ $id }} ? 'Cancel' : 'Select'"></span>
            </button>
        </div>
    </div>
@endif
