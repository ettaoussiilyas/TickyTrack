@extends('layouts.user.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="max-w-3xl mx-auto">
            {{-- Header Section with Back Button and Ticket Info --}}
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
{{--                        <a href="{{ route('user.tickets.my') }}" class="text-indigo-600 hover:text-indigo-900 mr-4">--}}
                        <a href="{{ route('user.tickets.index') }}" class="text-indigo-600 hover:text-indigo-900 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </a>
                        <h1 class="text-2xl font-bold text-gray-900">Ticket #{{ $ticket->id }}</h1>
                    </div>
                    <span class="px-3 py-1 text-sm rounded-full
                    @if($ticket->status === 'open') bg-green-100 text-green-800
                    @elseif($ticket->status === 'in_progress') bg-yellow-100 text-yellow-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                </span>
                </div>
            </div>

            {{-- Ticket Details Card --}}
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $ticket->title }}</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Created on {{ $ticket->created_at->format('M d, Y \a\t h:i A') }}
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Category</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $ticket->category->name }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $ticket->description }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $ticket->updated_at->format('M d, Y \a\t h:i A') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mt-4 rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>
@endsection
