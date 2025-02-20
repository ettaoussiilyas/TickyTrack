<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    @include('layouts.admin.sidebar')

    {{-- Main Content --}}
    <div class="lg:pl-64">
        {{-- Header --}}
        @include('layouts.admin.header')

        {{-- Page Content --}}
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
