<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('My Clients') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Manage your active training clients and schedules') }}</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-900/30 border border-green-500/50 rounded-lg text-green-300">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 rounded-lg text-red-300">
            {{ session('error') }}
        </div>
        @endif

            @if($contracts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($contracts as $contract)
                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-6 hover:border-red-600/50 transition">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-grow">
                                    <h3 class="text-xl font-bold text-white">{{ $contract->client->nama ?? $contract->client->email }}</h3>
                                    <p class="text-gray-400 text-sm">{{ __('Member') }}</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>

                            <div class="space-y-3 mb-6">
                                <div class="bg-gray-700/50 rounded-lg p-3">
                                    <p class="text-gray-400 text-xs mb-1">{{ __('Email') }}</p>
                                    <p class="text-white font-semibold text-sm break-all">{{ $contract->client->email }}</p>
                                </div>

                                <div class="bg-gray-700/50 rounded-lg p-3">
                                    <p class="text-gray-400 text-xs mb-1">{{ __('Contract End Date') }}</p>
                                    <p class="text-white font-semibold text-sm">
                                        {{ \Carbon\Carbon::parse($contract->tanggal_berakhir)->format('d M Y') }}
                                    </p>
                                </div>

                                @php
                                    $daysRemaining = intval(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($contract->tanggal_berakhir), false));
                                    $isExpired = $daysRemaining < 0;
                                @endphp

                                <div class="bg-gray-700/50 rounded-lg p-3">
                                    <p class="text-gray-400 text-xs mb-1">{{ __('Status') }}</p>
                                    <p class="font-semibold text-sm flex items-center gap-2">
                                        @if($isExpired)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-red-400">{{ __('Expired') }}</span>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-green-400">{{ __('Active') }} ({{ abs($daysRemaining) }} {{ __('days') }})</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('trainer.clients.edit', $contract->id) }}" 
                                   class="flex-1 px-3 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-semibold text-sm transition duration-300 text-center">
                                    {{ __('Manage') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Active Clients') }}</h3>
                <p class="text-gray-400 mb-6">{{ __('You currently have no active training clients') }}</p>
                    <a href="{{ route('homepage') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back Home') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
