<x-user-layout>
    {{-- <div class="z-50 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm w-48"
                        id="dropdown-user">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium ">{{ Auth::user()->name }}</div>
                            <div class="truncate">Administrator</div>
                        </div>
                        <ul class="py-1" role="none">
                            <li><form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="block w-full text-red-500 hover:text-red-600 cursor-pointer hover:bg-gray-100">
                                    <div class="px-4 py-3 flex items-center gap-2">
                                        <x-eos-logout class="w-5 h-5"/>
                                        <span>Signout</span>
                                    </div>
                                </button>
                            </form></li>
                        </ul>
                    </div> --}}
    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-center text-gray-800 mb-8 pt-8">
        Pemilihan Ketua Kelas<br>Magyasaka
    </h1>
    <div class="p-8 md:p-16" x-data="{
        selectedCard: null,
        selectedName: null,
    }">
        @if(isset($candidates))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-4">
            @foreach($candidates as $candidate)
            <x-card-vote id="{{ $candidate->candidate_id }}"
                name="{{ $candidate->name }}" vision="{{ $candidate->vision }}"
            mission="{{ $candidate->mission }}" picture="{{ $candidate->photo }}"></x-card-vote>
            @endforeach
        </div>
            <form action="{{ route('vote.store') }}" method="post" class="flex mt-24 justify-center items-center">
                @csrf
                <input type="text" class="hidden" x-bind:value="selectedCard" name="candidate_id" id="candidate_id">
                <button type="button"
                    @click="selectedCard !== null ? $dispatch('open-modal', 'confirmation-modal-{{ $candidate->candidate_id }}') : $dispatch('open-modal', 'warning-modal')"
                    class="flex gap-2 text-white bg-green-600 hover:bg-green-500  active:bg-green-700 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-green-500 font-medium rounded-full text-md px-8 py-2.5 text-center me-2 mb-2 transition-colors">
                    <x-fluentui-vote-20 class="w-6 h-6" />
                    Submit
                </button>
                <x-modal name="confirmation-modal-{{ $candidate->candidate_id }}">
                    <div class="flex justify-between p-6">
                        <h2 class="poppins-semibold text-xl">Confirm Your Vote</h2>
                        <button @click="$dispatch('close-modal', 'confirmation-modal-{{ $candidate->candidate_id }}')" type="button"
                            class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                            <x-eos-close class="w-5 h-5" />
                        </button>
                    </div>
                    <hr>
                    <div class="flex justify-between p-6">
                        <p class="poppins-regular text-md">Are you sure you want to submit your vote for <span
                                x-text="selectedName"></span>? Once
                            submitted, your
                            vote cannot be changed.</p>
                    </div>
                    <hr>
                    <div class="flex justify-end gap-2 p-6 poppins-regular">
                        <button type="button" @click="$dispatch('close-modal', 'confirmation-modal-{{ $candidate->candidate_id }}')"
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
        @else
        <div class="col-span-2">
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                <h1 class="text-xl poppins-medium">No candidates found!</h1>
            </div>
        </div>
        @endif
    </div>
</x-user-layout>
