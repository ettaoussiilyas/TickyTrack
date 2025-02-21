@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Statistics Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users Card -->
            <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="text-3xl font-bold mb-2">{{ $statistics['total_users'] }}</div>
                <div class="flex space-x-4 text-sm">
                    <span>Admins: {{ $statistics['total_admins'] }}</span>
                    <span>Agents: {{ $statistics['total_agents'] }}</span>
                </div>
            </div>

            <!-- Open Tickets Card -->
            <div class="bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Open Tickets</h3>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-3xl font-bold">{{ $statistics['open_tickets'] }}</div>
                <div class="text-sm mt-2">Awaiting Response</div>
            </div>

            <!-- In Progress Card -->
            <div class="bg-gradient-to-br from-blue-400 to-cyan-500 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">In Progress</h3>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="text-3xl font-bold">{{ $statistics['in_progress_tickets'] }}</div>
                <div class="text-sm mt-2">Being Handled</div>
            </div>

            <!-- Closed Tickets Card -->
            <div class="bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Closed Tickets</h3>
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="text-3xl font-bold">{{ $statistics['closed_tickets'] }}</div>
                <div class="text-sm mt-2">Successfully Resolved</div>
            </div>
        </div>

        <!-- Percentage Bar -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Ticket Distribution</h3>
            <div class="h-4 flex rounded-full overflow-hidden">
                @php
                    $total = $statistics['total_tickets'];
                    $openWidth = $total ? ($statistics['open_tickets'] / $total * 100) : 0;
                    $inProgressWidth = $total ? ($statistics['in_progress_tickets'] / $total * 100) : 0;
                    $closedWidth = $total ? ($statistics['closed_tickets'] / $total * 100) : 0;
                @endphp
                <div class="bg-yellow-400" style="width: {{ $openWidth }}%"></div>
                <div class="bg-blue-500" style="width: {{ $inProgressWidth }}%"></div>
                <div class="bg-green-500" style="width: {{ $closedWidth }}%"></div>
            </div>
            <div class="flex justify-between mt-2 text-sm">
                <span class="text-yellow-600">Open ({{ number_format($openWidth, 1) }}%)</span>
                <span class="text-blue-600">In Progress ({{ number_format($inProgressWidth, 1) }}%)</span>
                <span class="text-green-600">Closed ({{ number_format($closedWidth, 1) }}%)</span>
            </div>
        </div>
    </div>
@endsection
