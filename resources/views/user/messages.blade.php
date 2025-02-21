@extends('layouts.user.app')

@section('content')
    <div class="flex h-[calc(100vh-64px)]">
        <!-- Tickets List -->
        <div class="w-1/3 border-r border-gray-200 bg-white overflow-y-auto">
            <div class="p-4">
                <h2 class="text-lg font-semibold text-gray-900">My Tickets</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @foreach($tickets as $ticket)
                    <button
                        onclick="loadMessages({{ $ticket->id }})"
                        class="w-full px-4 py-3 flex items-center hover:bg-gray-50 focus:outline-none {{ request()->query('ticket') == $ticket->id ? 'bg-indigo-50' : '' }}"
                    >
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    #{{ $ticket->id }} - {{ $ticket->title }}
                                </p>
                                <span class="text-xs {{ $ticket->status === 'open' ? 'text-green-600' : 'text-gray-500' }}">
                                {{ ucfirst($ticket->status) }}
                            </span>
                            </div>
                            <p class="text-sm text-gray-500 truncate">
                                {{ Str::limit($ticket->description, 50) }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 flex flex-col bg-gray-50" id="messages-container">
            @if(request()->has('ticket'))
                <div class="flex-1 p-4 overflow-y-auto" id="messages-list">
                    <!-- Add debugging info -->
                    @if($messages->isEmpty())
                        <p class="text-center text-gray-500">No messages yet</p>
                    @endif

                    @foreach($messages as $message)
                        <div class="mb-4 flex {{ $message->user->role === 'agent' ? 'justify-start' : 'justify-end' }}">
                            <div class="max-w-lg {{ $message->user->role === 'agent' ? 'bg-white' : 'bg-indigo-100' }} rounded-lg px-4 py-2 shadow">
                                <p class="text-sm text-gray-900">{{ $message->content }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    {{ $message->created_at->format('M d, H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-4 border-t border-gray-200 bg-white">
                    <form action="{{ route('user.messages.store') }}" method="POST" class="flex space-x-2">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ request()->query('ticket') }}">
                        <input
                            type="text"
                            name="content"
                            class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Type your message..."
                            required
                        >
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Send
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex items-center justify-center">
                    <p class="text-gray-500">Select a ticket to view messages</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function loadMessages(ticketId) {
                window.location.href = `{{ route('user.messages') }}?ticket=${ticketId}`;
            }
        </script>
    @endpush
@endsection
