@extends('layouts.agent.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-xl font-semibold text-gray-800">My Assigned Tickets</h1>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                            <td class="px-6 py-4">{{ $ticket->title }}</td>
                            <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($ticket->status === 'open') bg-green-100 text-green-800
                                    @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('agent.tickets.edit', $ticket) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Update Status</a>
                                <a href="{{ route('agent.messages', ['ticket' => $ticket->id]) }}"
                                   class="ml-4 text-indigo-600 hover:text-indigo-900">View Messages</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
