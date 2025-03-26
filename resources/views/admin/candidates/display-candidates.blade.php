<x-admin-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif
    <div class="flex justify-end">
        <a href="{{ route('candidate.create') }}"
            class="bg-black text-white hover:bg-gray-800 p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Add Candidate</span>
        </a>
    </div>
    <div x-data="{
        selectedCard: null,
        names: ['Daniel', null]
    }" class="mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-4">
            @if (isset($candidates))
                @foreach ($candidates as $candidate)
                    <x-card-admin-candidates id="{{ $candidate->candidate_id }}" name="{{ $candidate->name }}" vision="{{ $candidate->vision }}"
                        mission="{{ $candidate->mission }}" picture="{{ $candidate->photo }}"></x-card-admin-candidates>
                @endforeach
            @else
                <div class="col-span-2">
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                        <h1 class="text-xl poppins-medium">No candidates found</h1>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
