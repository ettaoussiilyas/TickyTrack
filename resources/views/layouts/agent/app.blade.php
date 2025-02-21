<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Agent Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
    <!-- Off-canvas menu for mobile -->
    <div x-show="sidebarOpen" class="lg:hidden">
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
    </div>

    <!-- Static sidebar for desktop -->
    @include('layouts.agent.sidebar')

    <!-- Main content -->
    <div class="lg:pl-64">
        @include('layouts.agent.header')

        <main class="py-6">
            @yield('content')
        </main>
    </div>
</div>

<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
