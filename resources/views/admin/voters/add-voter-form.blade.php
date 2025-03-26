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
    <div class="flex justify-start items-center gap-3">
        <a href="{{ route('voters.index') }}" class="text-sm hover:underline">Voters</a>
        <x-fluentui-chevron-right-16 class="w-3 h-3" />
        <span class="text-sm text-gray-500">Add Voter</span>
    </div>
    <form action="{{ route("voters.store") }}" method="post">
        @csrf
        <div class="flex flex-col gap-2 w-full bg-white rounded-lg shadow-sm poppins-regular mb-16" x-data="{ name: '' }">
            <div class="p-6 border-b border-gray-200">
                <h1 class="poppins-medium text-2xl">Add Voter Form</h1>
            </div>
            <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2">
                    <label for="name">Full name</label>
                    <x-text-input required id="name" name="name" placeholder="Enter full name" x-model="name"></x-text-input>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="nim">NIM</label>
                    <x-text-input required id="nim" name="nim" placeholder="Enter NIM"></x-text-input>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="password">Password</label>
                    <x-text-input required id="password" name="password" type="password" placeholder="Enter Password"></x-text-input>
                </div>
            </div>
            <div class="p-6">
                <div class="flex justify-start gap-2">
                    <button type="button" @click="$dispatch('open-modal', 'confirmation-modal')"
                        class="w-24 text-white bg-green-500 hover:bg-green-700 transition-all p-2 rounded-full poppins-medium">
                        Add
                    </button>
                    <x-modal name="confirmation-modal">
                        <div class="flex justify-between p-6">
                            <h2 class="poppins-semibold text-xl">Confirm Voter Addition</h2>
                            <button @click="$dispatch('close-modal', 'confirmation-modal')" type="button"
                                class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                                <x-eos-close class="w-5 h-5" />
                            </button>
                        </div>
                        <hr>
                        <div class="flex justify-between p-6">
                            <p class="poppins-regular text-md">Are you sure you want to add <span x-text="name"></span> to the eligible voters list? They will receive access to participate in the vote.</p>
                        </div>
                        <hr>
                        <div class="flex justify-end gap-2 p-6 poppins-regular">
                            <button type="button" @click="$dispatch('close-modal', 'confirmation-modal')"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-full font-medium text-sm text-white hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Add Voter
                            </button>
                        </div>
                    </x-modal>
                    <a href="{{ route("voters.index") }}">
                        <button
                            class="w-28 border border-black text-black bg-transparent hover:text-white hover:bg-black transition-all p-2 rounded-full">
                            Cancel
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
