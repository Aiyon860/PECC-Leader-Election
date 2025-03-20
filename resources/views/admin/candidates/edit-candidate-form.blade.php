<x-admin-layout>
    <div class="flex flex-col gap-2 w-full bg-white rounded-lg shadow-sm poppins-regular mb-16" x-data>
        <div class="p-6 border-b border-gray-200">
            <h1 class="poppins-medium text-2xl">Edit Candidate Form</h1>
        </div>
        <div class="p-6 flex flex-col lg:grid lg:grid-cols-2 gap-4">
            <div class="w-full flex flex-col gap-2">
                <label for="name">Full name</label>
                <x-text-input id="name" placeholder="Enter full name" value="Daniel Adi Pratama" class="bg-gray-50"></x-text-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="nim">NIM</label>
                <x-text-input id="nim" placeholder="Enter NIM" value="43323007" class="bg-gray-50"></x-text-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="vision">Vision</label>
                <x-textarea-input id="vision" placeholder="Enter vision" class="bg-gray-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et consequat sapien. Nunc at justo at enim porta maximus ut a erat. Praesent vestibulum elit</x-textarea-input>
            </div>
            <div class="w-full flex flex-col gap-2">
                <label for="mission">Mission</label>
                <x-textarea-input id="mission" placeholder="Enter mission" class="bg-gray-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et consequat sapien. Nunc at justo at enim porta maximus ut a erat. Praesent vestibulum elit sed purus consectetur, ac auctor erat interdum.</x-textarea-input>
            </div>
            <div class="w-full flex flex-col gap-2 col-span-2">
                <label for="image-file">Candidate image</label>
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
                                <p class="mb-2 text-sm text-gray-500"><span
                                        class="font-semibold">Click
                                        to
                                        upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">(MAX 5MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-start gap-2">
                        <form action="{{ route("edit-candidate-put") }}" method="post">
                            @csrf
                            @method('PUT')
                            <button @click="$dispatch('open-modal', 'confirmation-modal')" type="button"
                                class="w-full lg:w-44 text-white bg-indigo-500 hover:bg-indigo-700 transition-all p-2 rounded-full poppins-medium">
                                Save Changes
                            </button>
                            <x-modal name="confirmation-modal">
                                <div class="flex justify-between p-6">
                                    <h2 class="poppins-semibold text-xl">Confirm Candidate Update</h2>
                                    <button @click="$dispatch('close-modal', 'confirmation-modal')" type="button"
                                        class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                                        <x-eos-close class="w-5 h-5" />
                                    </button>
                                </div>
                                <hr>
                                <div class="flex justify-between p-6">
                                    <p class="poppins-regular text-md">Are you sure you want to update [Candidate Name]'s information? These changes will be immediately visible to voters.</p>
                                </div>
                                <hr>
                                <div class="flex justify-end gap-2 p-6 poppins-regular">
                                    <button type="button" @click="$dispatch('close-modal', 'confirmation-modal')"
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-medium text-sm text-white hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Save Changes
                                    </button>
                                </div>
                            </x-modal>
                        </form>
                        <a href="/candidates/">
                            <button
                                class="w-full lg:w-28 border border-black text-black bg-transparent hover:text-white hover:bg-black transition-all p-2 rounded-full">
                                Cancel
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
