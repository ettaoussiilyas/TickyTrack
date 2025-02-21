@extends('layouts.admin.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Detailed overview of system performance</p>
                </div>
                <div class="flex space-x-4">
                    <button class="px-4 py-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Export Report
                    </span>
                    </button>
                </div>
            </div>

            <!-- Main Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- User Statistics Card -->
                <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-indigo-600/10"></div>
                    <div class="p-6 relative">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">User Base</h3>
                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $statistics['total_users'] }}</div>
                            <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-indigo-500 mr-2"></span>
                                    <span>Admins: {{ $statistics['total_admins'] }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="w-3 h-3 rounded-full bg-purple-500 mr-2"></span>
                                    <span>Agents: {{ $statistics['total_agents'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ticket Status Cards with Animation -->
                @php
                    $ticketCards = [
                        [
                            'title' => 'Open Tickets',
                            'value' => $statistics['open_tickets'],
                            'label' => 'Awaiting Response',
                            'colors' => 'from-amber-500 to-orange-500',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'bg' => 'bg-amber-100 dark:bg-amber-900/30',
                            'text' => 'text-amber-600 dark:text-amber-400'
                        ],
                        [
                            'title' => 'In Progress',
                            'value' => $statistics['in_progress_tickets'],
                            'label' => 'Being Handled',
                            'colors' => 'from-blue-500 to-cyan-500',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
                            'bg' => 'bg-blue-100 dark:bg-blue-900/30',
                            'text' => 'text-blue-600 dark:text-blue-400'
                        ],
                        [
                            'title' => 'Closed Tickets',
                            'value' => $statistics['closed_tickets'],
                            'label' => 'Successfully Resolved',
                            'colors' => 'from-green-500 to-emerald-500',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'bg' => 'bg-green-100 dark:bg-green-900/30',
                            'text' => 'text-green-600 dark:text-green-400'
                        ]
                    ];
                @endphp

                @foreach($ticketCards as $card)
                    <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $card['colors'] }}/10"></div>
                        <div class="p-6 relative">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $card['title'] }}</h3>
                                <div class="p-2 {{ $card['bg'] }} rounded-xl">
                                    <svg class="w-6 h-6 {{ $card['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $card['icon'] !!}
                                    </svg>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="text-3xl font-bold text-gray-900 dark:text-white">{{ $card['value'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $card['label'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Advanced Analytics Section -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Ticket Distribution Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Ticket Distribution</h3>
                    @php
                        $total = $statistics['total_tickets'];
                        $openWidth = $total ? ($statistics['open_tickets'] / $total * 100) : 0;
                        $inProgressWidth = $total ? ($statistics['in_progress_tickets'] / $total * 100) : 0;
                        $closedWidth = $total ? ($statistics['closed_tickets'] / $total * 100) : 0;
                    @endphp
                    <div class="space-y-4">
                        <!-- Open Tickets -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Open Tickets</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ number_format($openWidth, 1) }}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-500 rounded-full transition-all duration-500"
                                     style="width: {{ $openWidth }}%"></div>
                            </div>
                        </div>

                        <!-- In Progress Tickets -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">In Progress</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ number_format($inProgressWidth, 1) }}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full transition-all duration-500"
                                     style="width: {{ $inProgressWidth }}%"></div>
                            </div>
                        </div>

                        <!-- Closed Tickets -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Closed Tickets</span>
                                <span class="text-gray-900 dark:text-white font-medium">{{ number_format($closedWidth, 1) }}%</span>
                            </div>
                            <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-500"
                                     style="width: {{ $closedWidth }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Response Time Analysis -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Response Time Analysis</h3>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Average Response Time</p>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">2.5 hours</p>
                            </div>
                            <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Fastest Response</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">5 minutes</p>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <p class="text-sm text-gray-600 dark:text-gray-400">Slowest Response</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">4.2 hours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
