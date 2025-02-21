@extends('layouts.agent.app')

@section('content')
    <div class="flex h-screen bg-gray-100">
        <!-- Tickets Sidebar -->
        <div class="w-1/4 bg-white shadow-lg">
            <div class="p-4 border-b">
                <h2 class="text-lg font-semibold">Assigned Tickets</h2>
            </div>
            <div class="overflow-y-auto h-full">
                @foreach($tickets as $ticket)
                    <a href="{{ route('agent.messages', ['ticket' => $ticket->id]) }}"
                       class="block p-4 hover:bg-gray-50 border-b {{ request()->query('ticket') == $ticket->id ? 'bg-indigo-50' : '' }}">
                        <h3 class="font-medium">{{ $ticket->title }}</h3>
                        <p class="text-sm text-gray-600">{{ $ticket->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $ticket->created_at->diffForHumans() }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Messages Area -->
        <div class="flex-1 flex flex-col">
            @if(request()->has('ticket'))
                <div class="p-4 border-b bg-white shadow">
                    <h2 class="text-lg font-semibold">{{ $currentTicket->title }}</h2>
                    <p class="text-sm text-gray-600">Ticket #{{ $currentTicket->id }}</p>
                </div>

                <div class="flex-1 overflow-y-auto p-4">
                    @foreach($messages as $message)
                        <div class="mb-4 flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-lg {{ $message->user->id === auth()->id() ? 'bg-indigo-100' : 'bg-white' }} rounded-lg px-4 py-2 shadow">
                                <p class="text-sm font-medium">{{ $message->user->name }}</p>
                                <p class="text-sm">{{ $message->content }}</p>
                                <p class="text-xs text-gray-500">{{ $message->created_at->format('M d, H:i') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 bg-white border-t">
                    <form action="{{ route('agent.messages.store') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="ticket_id" value="{{ request()->query('ticket') }}">
                        <input type="text"
                               name="content"
                               class="flex-1 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Type your message..."
                               required>
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
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
@endsection
