@php
    $candidates = App\Models\Candidate::withCount('votes')->get();
    $hasCandidates = $candidates->isNotEmpty();
@endphp
<x-pie-chart></x-pie-chart>
<x-column-chart></x-column-chart>