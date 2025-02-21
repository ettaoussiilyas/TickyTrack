@extends('layouts.agent.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-lg mx-auto">
            <div class="bg-white shadow-md rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-xl font-semibold text-gray-800">Update Ticket Status</h1>
                </div>

                <form action="{{ route('agent.tickets.update', $ticket) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Ticket Title
                        </label>
                        <p class="text-gray-600">{{ $ticket->title }}</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                            Status
                        </label>
                        <select name="status" id="status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="pending" {{ $ticket->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="resolved" {{ $ticket->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            Description
                        </label>
                        <p class="text-gray-600">{{ $ticket->description }}</p>
                    </div>

                    <div class="flex items-center justify-end">
                        <a href="{{ route('agent.tickets.mytickets') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
