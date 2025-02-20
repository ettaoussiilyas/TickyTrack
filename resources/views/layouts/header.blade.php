<header class="bg-white shadow">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <div class="text-xl font-bold">
                <a href="{{ route('welcome') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="flex space-x-4">
                @auth
                    <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-gray-900">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Register</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
