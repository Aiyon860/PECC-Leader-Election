<x-admin-layout>
    <x-navbar-admin></x-navbar-admin>
    <div class="flex justify-end gap-4">
        <a href=""
            class="bg-black text-white hover:bg-gray-800 p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Add Voter</span>
        </a>
        <a href=""
            class="bg-gray-500 text-white p-3 rounded-lg flex justify-center items-center gap-2 transition-colors pointer-events-none">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Delete Voters</span>
        </a>
        <a href=""
            class="bg-transparent text-black border border-black hover:bg-black hover:text-white p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Import Excel</span>
        </a>
        <a href=""
            class="bg-transparent text-black border border-black hover:bg-black hover:text-white p-3 rounded-lg flex justify-center items-center gap-2 transition-colors">
            <x-feathericon-plus class="w-4 h-4" />
            <span class="text-sm">Export Excel</span>
        </a>
    </div>
    <x-voters-table></x-voters-table>
</x-admin-layout>