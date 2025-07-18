<x-admin-layout>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route("candidate.update", $candidate->candidate_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="flex flex-col gap-2 w-full bg-white rounded-lg shadow-sm poppins-regular mb-16" x-data="{ name: '{{ $candidate->name }}' }">
            <div class="p-6 border-b border-gray-200">
                <h1 class="poppins-medium text-2xl">Edit Candidate Form</h1>
            </div>
            <div class="p-6 flex flex-col lg:grid lg:grid-cols-2 gap-4">
                <div class="w-full flex flex-col gap-2 col-span-2">
                    <label for="name">Full name</label>
                    <x-text-input readonly id="name" name="name" placeholder="Enter full name" value="{{ $candidate->name }}"
                        class="bg-gray-50" x-model="name"></x-text-input>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="vision">Vision</label>
                    <x-textarea-input required id="vision" name="vision" placeholder="Enter vision" class="bg-gray-50">{{ $candidate->vision }}</x-textarea-input>
                </div>
                <div class="w-full flex flex-col gap-2">
                    <label for="mission">Mission</label>
                    <x-textarea-input required id="mission" name="mission" placeholder="Enter mission" class="bg-gray-50">{{ $candidate->mission }}</x-textarea-input>
                </div>
                <div class="w-full flex flex-col gap-2 col-span-2">
                    <label for="image-file">Candidate image</label>
                    <div id="image-file" class="flex flex-col gap-16">
                        <div id="image-file" class="flex flex-col gap-16" x-data="{ 
                            fileName: '',
                            filePreview: null,
                            fileInput: null,
                            
                            init() {
                                this.fileInput = document.getElementById('dropzone-file');
                                this.fileInput.addEventListener('change', this.handleFileChange.bind(this));
                            },
                            
                            handleFileChange() {
                                if (this.fileInput.files.length > 0) {
                                    const file = this.fileInput.files[0];
                                    
                                    // Cek apakah file adalah gambar
                                    if (file.type.startsWith('image/')) {
                                        this.fileName = file.name;
                                        
                                        // Membuat URL untuk preview gambar
                                        this.filePreview = URL.createObjectURL(file);
                                    }
                                } else {
                                    // Reset jika tidak ada file
                                    this.fileName = '';
                                    this.filePreview = null;
                                }
                            },
                            
                            removeFile() {
                                this.fileName = '';
                                this.filePreview = null;
                                this.fileInput.value = '';
                            }
                        }">
                            <div class="flex items-center justify-center w-full">
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 relative overflow-hidden">
                                    
                                    <!-- Preview File -->
                                    <template x-if="filePreview">
                                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-gray-50 z-10">
                                            <div class="relative">
                                                <img :src="filePreview" class="max-h-40 max-w-full object-contain mb-2 rounded-lg" />
                                                <button @click.prevent="removeFile()" type="button" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <p class="text-sm text-gray-600 mt-2" x-text="fileName"></p>
                                        </div>
                                    </template>
                                    
                                    <!-- Default State -->
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6" x-show="!filePreview">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">(MAX 5MB)</p>
                                    </div>
                                    
                                    <input id="dropzone-file" name="photo" type="file" accept="image/*" class="hidden" />
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:flex sm:justify-start gap-2">
                            <button type="button" @click="$dispatch('open-modal', 'confirmation-modal')"
                                class="w-full sm:w-48 text-white bg-indigo-500 hover:bg-indigo-700 transition-all p-2 rounded-full poppins-medium">
                                Save Changes
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
                                    <p class="poppins-regular text-md">Are you sure you want to update <span x-text="name"></span>'s information? These changes will be immediately visible to voters.</p>
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
                            <a href="/candidates">
                                <button
                                    type="button"
                                    class="w-full sm:w-28 border border-black text-black bg-transparent hover:text-white hover:bg-black transition-all p-2 rounded-full">
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
