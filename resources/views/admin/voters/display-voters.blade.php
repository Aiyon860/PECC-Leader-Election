<x-admin-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-green-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif
    <div x-data="{
        checkAll: false,
        checkedCount: 0,
        updateCheckedCount() {
            const checkboxes = document.querySelectorAll('[id^=checkbox-table-search-]');
            this.checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        }
    }" x-init="updateCheckedCount()" class="flex flex-col gap-6">
        <div class="lg:hidden flex justify-end">
            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                class="text-white bg-black hover:bg-gray-700 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                type="button">Menu <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="{{ route('voters.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100 w-full">
                            <div class="flex items-center gap-2">
                                <x-feathericon-plus class="w-4 h-4" />
                                <span class="text-sm">Add Voter</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <button type="button"
                            class="w-full block px-4 py-2 hover:bg-gray-100" @click="checkedCount >= 2 && $dispatch('open-modal', 'confirmation-modal-delete-voters')" x-bind:class="checkedCount < 2 ? 'bg-gray-100 cursor-not-allowed' : 'bg-white hover:bg-gray-100 cursor-pointer'">
                            <div class="flex items-center gap-2">
                                <x-ionicon-trash-outline class="w-4 h-4" />
                                <span class="text-sm">Delete Voters</span>
                            </div>
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('voters.import') }}"
                            class="block w-full px-4 py-2 hover:bg-gray-100">
                            <div class="flex items-center gap-2">
                                <x-uni-import-o class="w-4 h-4" />
                                <span class="text-sm">Import Excel</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block w-full px-4 py-2 hover:bg-gray-100">
                            <div class="flex items-center gap-2">
                                <x-uni-export-o class="w-4 h-4" />
                                <span class="text-sm">Export Excel</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="hidden lg:flex justify-end gap-4">
            <a href="{{ route('voters.create') }}"
                class="bg-black text-white hover:bg-gray-700 p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
                <x-feathericon-plus class="w-4 h-4" />
                <span class="text-sm">Add Voter</span>
            </a>
            <a href="{{ route('voters.import') }}"
                class="bg-transparent text-black border border-black hover:bg-black hover:text-white p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
                <x-uni-import-o class="w-4 h-4" />
                <span class="text-sm">Import Excel</span>
            </a>
        </div>
        <livewire:user-table theme="tailwind"/>
    </div>
</x-admin-layout>
