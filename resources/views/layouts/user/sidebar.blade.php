<div class="fixed inset-y-0 left-0 z-50 w-64 bg-indigo-700 overflow-y-auto transition-transform duration-300 ease-in-out"
     :class="{'transform -translate-x-full': !sidebarOpen, 'transform translate-x-0': sidebarOpen}"
     @click.away="sidebarOpen = false">

    <div class="flex items-center justify-center h-16 bg-indigo-800">
        <span class="text-white text-2xl font-bold">{{ config('app.name') }}</span>
    </div>

    <nav class="mt-8">
        <div class="px-2 space-y-1">
            {{-- Dashboard --}}
            <a href="{{ route('user.dashboard') }}"
               class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('user.dashboard') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- My Tickets --}}
            <a href="{{ route('user.tickets.index') }}"
               class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('user.tickets.*') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                My Tickets
            </a>

            {{-- Create New Ticket --}}
            <a href="{{ route('user.tickets.create') }}"
               class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('user.tickets.create') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Ticket
            </a>

            {{-- Messages --}}
            <a href="{{ route('user.messages') }}"
               class="flex items-center px-4 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('user.messages') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-600' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
                Messages
            </a>

        </div>
    </nav>

    {{-- Logout Section --}}
    <div class="absolute bottom-0 left-0 right-0 p-4">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                    class="flex items-center w-full px-4 py-2 text-sm font-medium text-indigo-100 hover:bg-indigo-600 rounded-lg">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
