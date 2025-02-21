@extends('layouts.agent.app')

@section('content')
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Tickets Sidebar -->
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Assigned Tickets</h2>
                <div class="mt-2 relative">
                    <input type="text"
                           placeholder="Search tickets..."
                           class="w-full pl-10 pr-4 py-2 border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:border-blue-500 dark:focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300">
                    <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <div class="overflow-y-auto h-[calc(100vh-5rem)]">
                @foreach($tickets as $ticket)
                    <a href="{{ route('agent.messages', ['ticket' => $ticket->id]) }}"
                       class="block border-b border-gray-200 dark:border-gray-700 transition-colors duration-200
                          {{ request()->query('ticket') == $ticket->id
                             ? 'bg-blue-50 dark:bg-blue-900/30 border-l-4 border-l-blue-500'
                             : 'hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full
                                {{ $ticket->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500' :
                                   ($ticket->status === 'in_progress' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-500' :
                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500') }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $ticket->created_at->diffForHumans() }}</span>
                            </div>
                            <h3 class="font-medium text-gray-900 dark:text-white truncate">{{ $ticket->title }}</h3>
                            <div class="flex items-center mt-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-r from-purple-400 to-blue-500 flex items-center justify-center text-white text-xs font-medium">
                                    {{ substr($ticket->user->name, 0, 1) }}
                                </div>
                                <p class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ $ticket->user->name }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 flex flex-col bg-white dark:bg-gray-800">
            @if(request()->has('ticket'))
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $currentTicket->title }}</h2>
                            <div class="flex items-center mt-1 space-x-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Ticket #{{ $currentTicket->id }}</span>
                                <span class="w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600"></span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Created {{ $currentTicket->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    @foreach($messages as $message)
                        <div class="flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            @if($message->user->id !== auth()->id())
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-purple-400 to-blue-500 flex-shrink-0 flex items-center justify-center text-white text-sm font-medium">
                                    {{ substr($message->user->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="mx-2 max-w-lg">
                                @if($message->user->id !== auth()->id())
                                    <p class="text-sm font-medium text-gray-900 dark:text-white mb-1">{{ $message->user->name }}</p>
                                @endif
                                <div class="rounded-2xl px-4 py-2 space-y-1
                                {{ $message->user->id === auth()->id()
                                   ? 'bg-blue-500 text-white'
                                   : 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' }}">
                                    <p class="text-sm">{{ $message->content }}</p>
                                    <p class="text-xs {{ $message->user->id === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $message->created_at->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                            @if($message->user->id === auth()->id())
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex-shrink-0 flex items-center justify-center text-white text-sm font-medium">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <form action="{{ route('agent.messages.store') }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ request()->query('ticket') }}">
                        <div class="relative flex-1">
                            <input type="text"
                                   name="content"
                                   class="w-full pl-4 pr-12 py-3 border-gray-200 dark:border-gray-600 rounded-xl focus:border-blue-500 dark:focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                   placeholder="Type your message..."
                                   required>
                            <button type="button" class="absolute right-2 top-2 p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit"
                                class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl transition-colors duration-200 flex items-center">
                            <span>Send</span>
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No Conversation Selected</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Choose a ticket from the sidebar to start messaging</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
