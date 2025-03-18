<div class="flex justify-between">
    <!-- drawer init and show -->
    <div class="text-center flex justify-center items-center">
        <button class="text-black hover:text-[#5c5c5c] font-medium rounded-lg text-sm transition-colors"
            type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation">
            <x-fluentui-panel-left-expand-16-o class="w-7 h-7" />
        </button>
    </div>
    <div class="flex gap-4">
        <button type="button"
            class="relative inline-flex items-center text-sm font-medium text-center text-black rounded-lg focus:outline-none">
            <x-fas-bell class="w-6 h-6" />
            <span class="sr-only">Notifications</span>
            <div
                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-white rounded-full -top-2 -end-2">
                20</div>
        </button>
        <div>
            <img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500"
                src="{{ Vite::asset('resources/assets/images/placeholder.jpg') }}" alt="Bordered avatar">
        </div>
    </div>
</div>