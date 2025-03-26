<x-admin-layout>
    <div class="flex flex-col gap-4 lg:grid lg:grid-cols-2 lg:gap-6">
        <x-pie-chart></x-pie-chart>
        <x-column-chart></x-column-chart>
        <div class="col-span-2">
            <livewire:dashboard-admin-user-table theme="tailwind"/>
        </div>
    </div>
</x-admin-layout>
