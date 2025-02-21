@extends('layouts.user.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('user.tickets.index') }}"
                       class="flex items-center justify-center w-10 h-10 rounded-lg bg-white dark:bg-gray-800 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Ticket #{{ $ticket->id }}</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Viewing ticket details and updates</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium
                    @if($ticket->status === 'open')
                        bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                    @elseif($ticket->status === 'in_progress')
                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                    @else
                        bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300
                    @endif">
                    <span class="w-2 h-2 mr-2 rounded-full
                        @if($ticket->status === 'open')
                            bg-green-400
                        @elseif($ticket->status === 'in_progress')
                            bg-yellow-400
                        @else
                            bg-gray-400
                        @endif">
                    </span>
                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                </span>
                    <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Ticket Details Card -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ $ticket->title }}</h2>
                            <div class="prose dark:prose-invert max-w-none">
                                <p class="text-gray-600 dark:text-gray-300">{{ $ticket->description }}</p>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700">
                            <dl>
                                <div class="px-6 py-4 grid grid-cols-3 gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white col-span-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                        {{ $ticket->category->name }}
                                    </span>
                                    </dd>
                                </div>
                                <div class="px-6 py-4 grid grid-cols-3 gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Created</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white col-span-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>{{ $ticket->created_at->format('M d, Y \a\t h:i A') }}</span>
                                    </dd>
                                </div>
                                <div class="px-6 py-4 grid grid-cols-3 gap-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</dt>
                                    <dd class="text-sm text-gray-900 dark:text-white col-span-2 flex items-center space-x-2">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>{{ $ticket->updated_at->format('M d, Y \a\t h:i A') }}</span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mt-4 rounded-lg bg-green-50 dark:bg-green-900/30 p-4 animate-fade-in-down">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800 dark:text-green-400">
                                        {{ session('success') }}
                                    </p>
                                </div>
                                <div class="ml-auto pl-3">
                                    <div class="-mx-1.5 -my-1.5">
                                        <button type="button" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 dark:hover:bg-green-800/50 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                            <span class="sr-only">Dismiss</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reply to Ticket
                            </button>
                            <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Demande to Resolvement
                            </button>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Activity Timeline</h3>
                        <div class="flow-root">
                            <ul class="-mb-8">
                                <!-- Timeline items would go here -->
                                <li class="relative pb-8">
                                    <div class="relative flex space-x-3">
                                        <div>
                                        <span class="h-8 w-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                        </span>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <div>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">Ticket created</p>
                                                <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $ticket->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
