<x-admin-layout>
    <div class="flex flex-col gap-2 w-full bg-white rounded-lg shadow-sm poppins-regular mb-16" x-data>
        <div class="p-6 border-b border-gray-200">
            <h1 class="poppins-medium text-2xl">Add Candidate Form</h1>
        </div>
        <div class="p-6 flex flex-col lg:grid lg:grid-cols-2 gap-4">
            <div class="w-full flex flex-col gap-2">
                <label for="name">Full name</label>
                <x-text-input id="name" placeholder="Enter full name" class="bg-gray-50"></x-text-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="nim">NIM</label>
                <x-text-input id="nim" placeholder="Enter NIM" class="bg-gray-50"></x-text-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="vision">Vision</label>
                <x-textarea-input id="vision" placeholder="Enter vision" class="bg-gray-50"></x-textarea-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="mission">Mission</label>
                <x-textarea-input id="mission" placeholder="Enter mission" class="bg-gray-50"></x-textarea-input>
            </div>
            <div class="w-full flex flex-col gap-2 col-span-2">
                <div for="image-file">Candidate image</div>
                <div id="image-file" class="flex flex-col gap-16">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                        to
                                        upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">(MAX 5MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                    <div class="flex justify-start gap-2">
                        <form action="{{ route("add-candidate-post") }}" method="post">
                            @csrf
                            <button type="button" @click="$dispatch('open-modal', 'confirmation-modal')"
                                class="w-24 text-white bg-green-500 hover:bg-green-700 transition-all p-2 rounded-full poppins-medium">
                                Add
                            </button>
                            <x-modal name="confirmation-modal">
                                <div class="flex justify-between p-6">
                                    <h2 class="poppins-semibold text-xl">Confirm Candidate Addition</h2>
                                    <button @click="$dispatch('close-modal', 'confirmation-modal')" type="button"
                                        class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                                        <x-eos-close class="w-5 h-5" />
                                    </button>
                                </div>
                                <hr>
                                <div class="flex justify-between p-6">
                                    <p class="poppins-regular text-md">Are you sure you want to add [Candidate Name] to the ballot? Once added, they will be visible to all voters.</p>
                                </div>
                                <hr>
                                <div class="flex justify-end gap-2 p-6 poppins-regular">
                                    <button type="button" @click="$dispatch('close-modal', 'confirmation-modal')"
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-full font-medium text-sm text-white hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Add Candidate
                                    </button>
                                </div>
                            </x-modal>
                        </form>
                        <a href="/candidates">
                            <button
                                class="w-28 border border-black text-black bg-transparent hover:text-white hover:bg-black transition-all p-2 rounded-full">
                                Cancel
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
