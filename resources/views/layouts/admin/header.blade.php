<header class="bg-white shadow">
    <div class="flex justify-between items-center px-4 py-3">
        {{-- Left side with mobile menu and title --}}
        <div class="flex items-center">
            <button type="button"
                    class="lg:hidden p-2 text-gray-500 hover:text-gray-600"
                    @click="sidebarOpen = !sidebarOpen">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="ml-2 text-xl font-semibold text-gray-800">@yield('header-title', 'Dashboard')</h1>
        </div>

        {{-- Right side user menu --}}
        <div class="relative" x-data="{ open: false }">

            <div class="flex items-center space-x-4">
                <img class="h-8 w-8 rounded-full"
                     src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                     alt="">
                <span class="text-gray-700">{{ Auth::user()->name }}</span>

            </div>
        </div>
    </div>
</header>
