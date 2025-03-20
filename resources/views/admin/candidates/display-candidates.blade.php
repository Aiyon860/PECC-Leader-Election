<x-admin-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    <div class="flex justify-end">
        <a href="{{ route('add-candidate-page') }}"
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
            <x-card-admin-candidates id="1" name="Daniel" vision="aabcc"
                mission="bbacc"></x-card-admin-candidates>
            <x-card-admin-candidates :id="2"></x-card-admin-candidates>
        </div>
    </div>
</x-admin-layout>
