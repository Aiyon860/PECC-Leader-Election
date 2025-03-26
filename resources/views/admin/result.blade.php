<x-admin-layout>
    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2" x-data="{
        selectedCard: null,  
    }">
        @if (isset($candidates))
            @foreach ($candidates as $candidate)
                <x-card-result id="{{ $candidate->candidate_id }}" name="{{ $candidate->name }}" picture="{{ $candidate->photo }}" totalVotes="{{ $candidate->votes_count }}"></x-card-result>            
            @endforeach
        @else
            <div class="col-span-2">
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                    <h1 class="text-xl poppins-medium">No candidates found! Please add a candidate first</h1>
                </div>
            </div>
        @endif
    </div>
</x-admin-layout>