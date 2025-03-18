<x-admin-layout>
    <x-navbar-admin></x-navbar-admin>
    <div class="flex justify-end">
        <a href=""
            class="bg-black text-white hover:bg-gray-800 p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Add Candidate</span>
        </a>
    </div>
    <div x-data="{
        selectedCard: null,
        names: ['Daniel', null]
    }" class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-4">
            <x-card-admin-candidates id="1" name="Daniel" vision="aabcc"
                mission="bbacc"></x-card-admin-candidates>
            <x-card-admin-candidates :id="2"></x-card-admin-candidates>
        </div>
        {{-- wip --}}
        <x-modal name="warning-modal">
            <div class="flex justify-between p-6">
                <h2 class="poppins-semibold text-xl">Oops! No Candidate Selected</h2>   
                <button @click="$dispatch('close-modal', 'warning-modal')"
                    class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                    <x-eos-close class="w-5 h-5" />
                </button>
            </div>
            <hr>
            <div class="flex justify-between p-6">
                <p class="poppins-regular text-md">Please select a candidate before submitting your vote.</p>
            </div>
        </x-modal>
    </div>
</x-admin-layout>
