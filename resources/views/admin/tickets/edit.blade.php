@extends('layouts.admin.app')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <nav class="mb-8 flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                <a href="{{ route('admin.tickets.index') }}" class="hover:text-blue-600 dark:hover:text-blue-400">Tickets</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span>Edit Ticket #{{ $ticket->id }}</span>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Edit Ticket</h1>
                        <span class="px-3 py-1 text-sm rounded-full
                        {{ $ticket->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500' :
                           ($ticket->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-500' :
                            'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500') }}">
                        Current Status: {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                    </span>
                    </div>

                    <form action="{{ route('admin.tickets.update', $ticket) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="space-y-1">
                            <label for="title" class="text-sm font-medium text-gray-900 dark:text-gray-200">Title</label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title', $ticket->title) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            @error('title')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="space-y-1">
                            <label for="description" class="text-sm font-medium text-gray-900 dark:text-gray-200">Description</label>
                            <textarea name="description"
                                      id="description"
                                      rows="6"
                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white resize-none">{{ old('description', $ticket->description) }}</textarea>
                            @error('description')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Agent Assignment -->
                            <div class="space-y-1">
                                <label for="agent_id" class="text-sm font-medium text-gray-900 dark:text-gray-200">Assign To</label>
                                <div class="relative">
                                    <select name="agent_id"
                                            id="agent_id"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white appearance-none">
                                        <option value="">Select Agent</option>
                                        @foreach($agents as $agent)
                                            <option value="{{ $agent->id }}"
                                                {{ old('agent_id', $ticket->agent_id) == $agent->id ? 'selected' : '' }}>
                                                {{ $agent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                                @error('agent_id')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="space-y-1">
                                <label for="status" class="text-sm font-medium text-gray-900 dark:text-gray-200">Status</label>
                                <div class="relative">
                                    <select name="status"
                                            id="status"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white appearance-none">
                                        <option value="pending" {{ old('status', $ticket->status) == 'pending' ? 'selected' : '' }}>Open</option>
                                        <option value="in_progress" {{ old('status', $ticket->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ old('status', $ticket->status) == 'resolved' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    <svg class="w-5 h-5 text-gray-400 absolute right-3 top-3.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                                @error('status')
                                <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400">
                                <span>Created: {{ $ticket->created_at->format('M d, Y H:i') }}</span>
                                <span>Last Updated: {{ $ticket->updated_at->format('M d, Y H:i') }}</span>
                                <span>Created by: {{ $ticket->user->name }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a href="{{ route('admin.tickets.index') }}"
                               class="px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
