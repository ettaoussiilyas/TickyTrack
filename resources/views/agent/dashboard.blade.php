{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.agent.app')

@section('content')
    <h1>This is The Agent Dashboard</h1>
    <div class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Stats Cards -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 text-sm">Total Tickets</h2>
                        <p class="text-2xl font-semibold text-gray-800">{{ $totalTickets }}</p>
                    </div>
                </div>
            </div>

            <!-- Add more stat cards here -->
        </div>

        <!-- Recent Tickets Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Tickets</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentTickets as $ticket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                            <td class="px-6 py-4">{{ $ticket->title }}</td>
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
                                <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-blue-600 hover:text-blue-900">View</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
