@props(['id', 'name', 'picture', 'vision', 'mission'])

@if ($id)
    <x-card x-data="{ isLargeScreen: window.innerWidth >= 768 }" x-init="window.addEventListener('resize', () => {
        isLargeScreen = window.innerWidth >= 768
    })"
        x-bind:class="selectedCard === {{ $id }} ?
            (isLargeScreen ?
                'outline outline-4 outline-blue-500 transform -translate-y-7 transition-all duration-300' :
                'outline outline-4 outline-blue-500 transition-all') :
            'transform translate-y-0 transition-all duration-300'"
        id="{{ $id }}" name="{{ $name }}" picture="{{ $picture }}" vision="{{ $vision }}" mission="{{ $mission }}">
    </x-card>
@endif
