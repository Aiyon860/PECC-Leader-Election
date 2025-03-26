<!-- Modal Delete Confirmation -->
@if ($showDeleteModal)
    <div class="fixed inset-0 !overflow-y-hidden px-4 py-6 sm:px-0 z-50 flex justify-center items-center" x-data
        x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="prevFocusable().focus()">
        <div class="fixed inset-0 transform transition-all" x-on:click="show = false"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto sm:max-w-2xl"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div class="flex justify-between p-6">
                <h2 class="poppins-semibold text-xl">Confirm Deletion</h2>
                <button wire:click="cancelDelete" type="button"
                    class="w-6 h-6 text-black hover:text-white bg-white hover:bg-black focus:border-2 focus:border-black flex justify-center items-center transition-all rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <hr>
            <div class="flex justify-between p-6">
                @if (!$userIdBeingDeleted)
                    <p class="poppins-regular text-md">Are you sure you want to delete all selected users? This action
                        cannot be undone.</p>
                @else
                    <p class="poppins-regular text-md">Are you sure you want to delete <span
                            class="font-bold">{{ $name }}</span>? This action cannot be undone.</p>
                @endif
            </div>
            <hr>
            <div class="flex justify-end gap-2 p-6 poppins-regular">
                <button type="button" wire:click="cancelDelete"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-medium text-sm text-gray-700 shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Cancel
                </button>
                <button wire:click="deleteUser"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-full font-medium text-sm text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Delete
                </button>
            </div>
        </div>
    </div>
@endif
