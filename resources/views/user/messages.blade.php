@extends('layouts.user.app')

@section('content')
    <div class="h-[calc(100vh-64px)] flex bg-gray-50 dark:bg-gray-900">
        <!-- Tickets Sidebar -->
        <div class="w-96 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">My Tickets</h2>
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                        </svg>
                    </button>
                </div>
                <div class="relative">
                    <input type="text"
                           placeholder="Search tickets..."
                           class="w-full px-4 py-2 pl-10 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Tickets List -->
            <div class="flex-1 overflow-y-auto">
                @foreach($tickets as $ticket)
                    <button
                        onclick="loadMessages({{ $ticket->id }})"
                        class="w-full p-4 flex flex-col gap-2 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->query('ticket') == $ticket->id ? 'bg-indigo-50 dark:bg-indigo-900/50 border-l-4 border-indigo-500' : '' }}"
                    >
                        <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            #{{ $ticket->id }} - {{ $ticket->title }}
                        </span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ $ticket->status === 'open' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-400' }}">
                            {{ ucfirst($ticket->status) }}
                        </span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                            {{ $ticket->description }}
                        </p>
                        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $ticket->created_at->diffForHumans() }}
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 flex flex-col">
            @if(request()->has('ticket'))
                <!-- Chat Header -->
                <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Ticket #{{ request()->query('ticket') }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $messages->count() }} messages</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Messages List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-list">
                    @forelse($messages as $message)
                        <div class="flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-lg {{ $message->user->id === auth()->id() ? 'bg-indigo-600 text-white' : 'bg-white dark:bg-gray-800' }} rounded-2xl px-5 py-3 shadow-sm">
                                <div class="flex items-center space-x-2 mb-1">
                                <span class="text-xs {{ $message->user->id === auth()->id() ? 'text-indigo-200' : 'text-gray-500 dark:text-gray-400' }}">
                                    {{ $message->user->name }}
                                </span>
                                </div>
                                <p class="text-sm">{{ $message->content }}</p>
                                <div class="mt-1 flex items-center justify-end">
                                <span class="text-xs {{ $message->user->id === auth()->id() ? 'text-indigo-200' : 'text-gray-400 dark:text-gray-500' }}">
                                    {{ $message->created_at->format('H:i') }}
                                </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex items-center justify-center h-full">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400">No messages yet</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500">Be the first to send a message</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Message Input -->
                <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    <form action="{{ route('user.messages.store') }}" method="POST" class="flex items-center space-x-4">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ request()->query('ticket') }}">
                        <div class="flex-1 relative">
                            <input
                                type="text"
                                name="content"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-600 pr-12"
                                placeholder="Type your message..."
                                required
                            >
                            <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-20 h-20 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Select a Ticket</h3>
                        <p class="text-gray-500 dark:text-gray-400">Choose a ticket from the list to view messages</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
