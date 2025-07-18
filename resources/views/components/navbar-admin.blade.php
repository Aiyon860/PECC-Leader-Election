<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="https://flowbite.com" class="flex ms-2 md:me-24 justify-center items-center gap-2">
                    <x-magyasaka-logo/>
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap">PECC</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex justify-center items-center gap-4">
                        {{-- wip --}}
                        {{-- <button type="button"
                            class="relative inline-flex items-center text-sm font-medium text-center text-black rounded-lg focus:outline-none">
                            <x-fas-bell class="w-6 h-6" />
                            <span class="sr-only">Notifications</span>
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-white rounded-full -top-2 -end-2">
                                20</div>
                        </button> --}}
                        <button type="button"
                            class="flex text-sm rounded-full focus:ring-4 focus:ring-gray-300"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <svg class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 cursor-pointer" alt="Bordered avatar" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm w-48"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ms-3">Dashboard</span>
                </a>
                <a href="{{ route('candidate.result') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <x-carbon-result class="w-5 h-5"/>
                    <span class="ms-3">Result</span>
                </a>
                <a href="{{ route('candidate.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <x-bi-people-fill class="w-5 h-5"/>
                    <span class="ms-3">Candidates</span>
                </a>
                <a href="{{ route('voters.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <x-fas-people-group class="w-5 h-5"/>
                    <span class="ms-3">Voters</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<main>
    <div class="p-4 sm:ml-64 flex flex-col gap-6 mt-20">
        {{ $slot }}
    </div>
</main>
