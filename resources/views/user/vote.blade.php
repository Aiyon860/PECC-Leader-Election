<x-user-layout>
    <div x-data="{
        selectedCard: null,
        names: ['Daniel', null]
    }" class="p-8 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-4">
            <x-card x-data="{ isLargeScreen: window.innerWidth >= 768 }" x-init="window.addEventListener('resize', () => {
                isLargeScreen = window.innerWidth >= 768
            })"
                x-bind:class="selectedCard === 1 ?
                    (isLargeScreen ?
                        'outline outline-4 outline-blue-500 transform -translate-y-7 transition-all duration-300' :
                        'outline outline-4 outline-blue-500 transition-all') :
                    'transform translate-y-0 transition-all duration-300'"
                id="1" name="Daniel" vision="aabcc" mission="bbacc">
            </x-card>
            <x-card x-data="{ isLargeScreen: window.innerWidth >= 768 }" x-init="window.addEventListener('resize', () => {
                isLargeScreen = window.innerWidth >= 768
            })"
                x-bind:class="selectedCard === 2 ?
                    (isLargeScreen ?
                        'outline outline-4 outline-blue-500 transform -translate-y-7 transition-all duration-300' :
                        'outline outline-4 outline-blue-500 transition-all') :
                    'transform translate-y-0 transition-all duration-300'"
                :id="2">
            </x-card>
        </div>
        <form action="{{ route('thank-you') }}" method="post" class="flex mt-24 justify-center items-center">
            @csrf
            <button type="button" @click="selectedCard !== null ? $dispatch('open-modal', 'confirmation-modal') : $dispatch('open-modal', 'warning-modal')"
                class="flex gap-2 text-white bg-green-600 hover:bg-green-500  active:bg-green-700 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-green-500 font-medium rounded-full text-md px-8 py-2.5 text-center me-2 mb-2 transition-colors">
                <x-fluentui-vote-20 class="w-6 h-6" />
                Submit
            </button>
            <x-modal name="confirmation-modal">
                <div class="flex justify-between p-6">
                    <h2 class="poppins-semibold text-xl">Confirm Your Vote</h2>
                    <button @click="$dispatch('close-modal', 'confirmation-modal')"
                        class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                        <x-eos-close class="w-5 h-5" />
                    </button>
                </div>
                <hr>
                <div class="flex justify-between p-6">
                    <p class="poppins-regular text-md">Are you sure you want to submit your vote for <span
                            x-text="selectedCard ? (names[selectedCard - 1] ?? 'no one 1') : 'no one'"></span>? Once submitted, your
                        vote cannot be changed.</p>
                </div>
                <hr>
                <div class="flex justify-end gap-2 p-6 poppins-regular">
                    <button type="button" @click="$dispatch('close-modal', 'confirmation-modal')"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-semibold text-sm text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Cancel
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Confirm
                    </button>
                </div>
            </x-modal>
        </form>
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
</x-user-layout>
