@php
    $candidates = App\Models\Candidate::withCount('votes')->get();
    $hasCandidates = $candidates->isNotEmpty();
@endphp

<div class="w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
    <div class="flex justify-between items-start w-full">
        <div class="flex-col items-center">
            <div class="flex items-center mb-1">
                <h5 class="text-2xl poppins-bold leading-none text-gray-900 me-1">Overview Chart</h5>
            </div>
        </div>
    </div>

    @if ($hasCandidates)
        <!-- Line Chart -->
        <div class="py-6" id="pie-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t justify-between"></div>
    @else
        <div class="py-12 text-center flex flex-col justify-center items-center h-full">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <h3 class="mt-2 text-sm font-semibold text-gray-900">No candidates found</h3>
            <p class="mt-1 text-sm text-gray-500">No candidate data is available to display in the chart.</p>
        </div>
    @endif
</div>