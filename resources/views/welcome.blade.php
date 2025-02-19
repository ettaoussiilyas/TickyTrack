@extends('layouts.app')

@section('content')
        <div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
            <div class="container mx-auto px-4 py-16">
                <!-- Hero Section -->
                <div class="text-center max-w-4xl mx-auto">
                    <h1 class="text-6xl font-extrabold text-gray-900 mb-6">
                        Support Ticket System
                        <span class="text-blue-600">Made Simple</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-10 leading-relaxed">
                        Streamline your customer support with our efficient ticket management system. Track, manage, and resolve customer issues seamlessly.
                    </p>
                    <div class="flex justify-center gap-6">
                        @guest
                            <a href="{{ route('register') }}"
                               class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                                Get Started
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endguest
                        <a href="#features"
                           class="inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-700 bg-white rounded-lg hover:bg-gray-50 border-2 border-gray-200 transition duration-300">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Features Section -->
                <div id="features" class="mt-32">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-16">Key Features</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                        <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Fast Response Time</h3>
                            <p class="text-gray-600 leading-relaxed">Quick ticket processing and real-time updates for efficient customer support management.</p>
                        </div>

                        <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Secure System</h3>
                            <p class="text-gray-600 leading-relaxed">Enhanced security measures to protect sensitive customer data and communications.</p>
                        </div>

                        <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition duration-300">
                            <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Analytics & Reports</h3>
                            <p class="text-gray-600 leading-relaxed">Comprehensive reporting tools to track support metrics and improve service quality.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
