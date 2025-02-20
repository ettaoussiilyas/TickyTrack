@extends('layouts.admin.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Tickets</h1>
                <a href="{{ route('admin.tickets.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Ticket
                </a>
            </div>

            <div class="mt-6">
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned To</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                                <td class="px-6 py-4">{{ $ticket->title }}</td>
                                <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($ticket->status === 'open') bg-green-100 text-green-800
                                    @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($ticket->status) }}
                                </span>
                                </td>
                                <td class="px-6 py-4">{{ $ticket->user->name }}</td>
                                <td class="px-6 py-4">{{ $ticket->assignedTo->name ?? 'Unassigned' }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                    <a href="{{ route('admin.tickets.edit', $ticket) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                    <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
