@extends('layouts.admin.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white sm:text-3xl">Tickets</h1>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Manage and track support tickets across your organization
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('admin.tickets.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-xl transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Ticket
                    </a>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="mt-8 flex flex-col md:flex-row gap-4">
                <div class="relative flex-1">
                    <input type="text"
                           placeholder="Search tickets..."
                           class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <div class="flex gap-4">
                    <select class="rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white px-4 py-2">
                        <option value="">All Statuses</option>
                        <option value="open">Open</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                    </select>
                    <select class="rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white px-4 py-2">
                        <option value="">All Agents</option>
                        <option value="unassigned">Unassigned</option>
                    </select>
                </div>
            </div>

            <!-- Tickets Grid -->
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($tickets as $ticket)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-200">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 text-xs font-medium rounded-full
                            {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500' :
                               ($ticket->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500' :
                                'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-500') }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">#{{ $ticket->id }}</span>
                            </div>

                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                {{ Str::limit($ticket->title, 50) }}
                            </h3>

                            <div class="flex items-center space-x-4 mb-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-400 to-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                        {{ substr($ticket->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $ticket->user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Created by</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                {{ $ticket->created_at->format('M d, Y') }}
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        @if($ticket->agent)
                                            <div class="w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-xs font-medium">
                                                {{ substr($ticket->agent->name, 0, 1) }}
                                            </div>
                                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ $ticket->agent->name }}</span>
                                        @else
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Unassigned</span>
                                        @endif
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}"
                                           class="p-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.tickets.edit', $ticket) }}"
                                           class="p-2 text-gray-600 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure?')"
                                                    class="p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
