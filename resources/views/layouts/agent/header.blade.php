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
            <h1 class="ml-2 text-xl font-semibold text-gray-800">@yield('header-title', 'Agent Dashboard')</h1>
        </div>
        {{-- Right side with notifications and user menu --}}
        <div class="flex items-center space-x-4">
            {{-- Notifications --}}
            <button class="p-2 text-gray-500 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>

            {{-- User Menu --}}
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full"
                     src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                     alt="{{ Auth::user()->name }}">
                <span class="ml-2 text-gray-700">{{ Auth::user()->name }}</span>
            </div>
        </div>
    </div>
</header>
