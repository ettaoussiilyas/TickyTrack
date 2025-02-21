@extends('layouts.agent.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4 py-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Welcome Back, {{ auth()->user()->name }}!
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Here's what's happening with your tickets today.
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Tickets -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-500/10 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Tickets</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalTickets }}</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm text-green-600">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        <span>12% increase</span>
                    </div>
                </div>

                <!-- Add more stat cards with different colors and icons -->
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- Recent Tickets -->
                <div class="xl:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Tickets</h2>
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                    View all →
                                </a>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach($recentTickets as $ticket)
                                <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                        <span class="w-10 h-10 bg-{{ getStatusColor($ticket->status) }}-100 text-{{ getStatusColor($ticket->status) }}-700 rounded-full flex items-center justify-center">
                                            {{ substr($ticket->title, 0, 1) }}
                                        </span>
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $ticket->title }}
                                                </h3>
                                                <div class="flex items-center mt-1 space-x-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                {{ getStatusClasses($ticket->status) }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $ticket->created_at->diffForHumans() }}
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>
                                            <a href="{{ route('agent.tickets.mytickets', $ticket) }}"
                                               class="p-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Recent Activity</h2>
                    <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            <!-- Add timeline items here -->
                            <li class="relative pb-8">
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700" aria-hidden="true"></span>
                                <div class="relative flex space-x-3">
                                    <div>
                                    <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                    </span>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">New ticket created</div>
                                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                            2 minutes ago
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <!-- Add more timeline items -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        function getStatusColor($status) {
            return match($status) {
                'pending' => 'yellow',
                'in_progress' => 'blue',
                'resolved' => 'green',
                default => 'gray'
            };
        }

        function getStatusClasses($status) {
            return match($status) {
                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500',
                'in_progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-500',
                'resolved' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500',
                default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-500'
            };
        }
    @endphp
@endsection
