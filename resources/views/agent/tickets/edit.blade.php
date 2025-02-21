@extends('layouts.agent.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <a href="{{ route('agent.tickets.mytickets') }}" class="inline-flex items-center mb-6 text-gray-600 hover:text-gray-900 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Tickets
            </a>

            <!-- Main Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white">Update Ticket Status</h1>
                    <p class="text-indigo-100 mt-2">Ticket #{{ $ticket->id }}</p>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <form action="{{ route('agent.tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Ticket Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Created By
                                    </label>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">{{ substr($ticket->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Current Status
                                    </label>
                                    <span class="px-4 py-2 rounded-full text-sm font-medium inline-block
                                    @if($ticket->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($ticket->status === 'in_progress') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Title
                                    </label>
                                    <p class="text-gray-900 dark:text-white font-medium">{{ $ticket->title }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Description
                                    </label>
                                    <p class="text-gray-600 dark:text-gray-400">{{ $ticket->description }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Status Update Section -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 mb-8">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Update Status</h3>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach(['pending', 'in_progress', 'resolved'] as $status)
                                    <label class="relative">
                                        <input type="radio" name="status" value="{{ $status }}"
                                               {{ $ticket->status === $status ? 'checked' : '' }}
                                               class="peer sr-only">
                                        <div class="w-full p-4 text-center rounded-lg border-2 cursor-pointer transition-all duration-200
                    peer-checked:border-indigo-600 peer-checked:bg-indigo-50 dark:peer-checked:bg-indigo-900/30
                    border-gray-200 dark:border-gray-600
                    hover:border-gray-300 dark:hover:border-gray-500
                    hover:shadow-md
                    peer-checked:shadow-lg peer-checked:shadow-indigo-100 dark:peer-checked:shadow-indigo-900/30
                    peer-checked:scale-105 transform
                    peer-checked:ring-2 peer-checked:ring-indigo-500 peer-checked:ring-offset-2 dark:peer-checked:ring-offset-gray-800">
                                            <div class="font-medium transition-colors
                        peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400
                        text-gray-900 dark:text-white">
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </div>
                                            <!-- Status Icon -->
                                            <div class="mt-2 flex justify-center">
                                                @if($status === 'pending')
                                                    <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @elseif($status === 'in_progress')
                                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <style>
                            /* Optional: Add smooth transitions for all properties */
                            .transition-all {
                                transition-property: all;
                                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                                transition-duration: 150ms;
                            }
                        </style>
                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('agent.tickets.mytickets') }}"
                               class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
