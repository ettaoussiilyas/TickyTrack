<div class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-900 overflow-y-auto
">
    <div class="flex items-center justify-center h-14">
        <span class="text-white text-2xl font-bold">{{ config('app.name') }}</span>
    </div>

    <nav class="mt-8">
        <div class="space-y-2">
            {{-- Dashboard Link --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Tickets Management --}}
            <a href="{{ route('admin.tickets.index') }}"
               class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg {{ request()->routeIs('admin.tickets.*') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Tickets
            </a>

            {{-- Users Management --}}
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Users
            </a>

            {{-- Statistics --}}
            <a href="{{ route('admin.statistics') }}"
               class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg {{ request()->routeIs('admin.reports') ? 'bg-gray-800' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Statistics
            </a>

        </div>
    </nav>

    {{-- Logout Section --}}
    <div class="absolute bottom-0 left-0 right-0 p-4">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                    class="flex items-center w-full px-4 py-2 text-gray-300 hover:bg-gray-800 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
