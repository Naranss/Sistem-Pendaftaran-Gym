<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('My Trainer') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Your personal fitness coach') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Trainer Info Card -->
            <div class="lg:col-span-2">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 overflow-hidden shadow-lg">
                    <!-- Trainer Header with Background -->
                    <div class="bg-gradient-to-r from-red-600 to-red-700 h-32"></div>
                    
                    <!-- Trainer Details -->
                    <div class="px-8 pb-8">
                        <!-- Trainer Avatar Section -->
                        <div class="flex flex-col sm:flex-row sm:items-end gap-6 -mt-16 mb-6">
                            <div class="flex-shrink-0">
                                <div class="w-32 h-32 rounded-xl bg-gradient-to-br from-red-400 to-red-600 border-4 border-gray-900 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="flex-grow">
                                <h2 class="text-3xl font-bold text-white mb-2">{{ $trainer->nama }}</h2>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-block px-4 py-2 bg-red-600/20 border border-red-500/50 rounded-lg text-red-400 text-sm font-semibold">
                                        {{ __('Professional Trainer') }}
                                    </span>
                                    <span class="inline-block px-4 py-2 bg-green-600/20 border border-green-500/50 rounded-lg text-green-400 text-sm font-semibold">
                                        ✓ {{ __('Active') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="space-y-4 mb-8">
                            <h3 class="text-xl font-bold text-white mb-4">{{ __('Contact Information') }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Email -->
                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">{{ __('Email') }}</span>
                                    </div>
                                    <p class="text-white font-semibold">{{ $trainer->email }}</p>
                                </div>

                                <!-- Phone -->
                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773c.021.06.032.12.032.184v.5c0 1.657.895 3.273 2.336 4.174.203.129.455.16.681.05l1.766-.884c.334-.167.582-.472.582-.822v-.5a2 2 0 00-2-2h-.5a2 2 0 00-2 2v.5c0 .35.248.655.582.822l1.766.884c.226.11.478.079.681-.05 1.441-.901 2.336-2.517 2.336-4.174v-.5c0-.064.011-.123.032-.184L15.7 9.978a1 1 0 01-.54-1.06l.74-4.435A1 1 0 0116.847 3h2.153a1 1 0 011 1v14a1 1 0 01-1 1h-2.153a1 1 0 01-.986-.836l-.74-4.435a1 1 0 01.54-1.06l1.548-.773c-.021-.06-.032-.12-.032-.184v-.5a2 2 0 002 2h.5a2 2 0 002-2v-.5c0-.35-.248-.655-.582-.822l-1.766-.884c-.226-.11-.478-.079-.681.05-1.441.901-2.336 2.517-2.336 4.174v.5c0 .064-.011.123-.032.184l-1.548.773a1 1 0 01-.54 1.06l.74 4.435a1 1 0 01-.986.836H3a1 1 0 01-1-1V3z" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">{{ __('Phone') }}</span>
                                    </div>
                                    <p class="text-white font-semibold">{{ $trainer->no_telp }}</p>
                                </div>

                                <!-- Gender -->
                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">{{ __('Gender') }}</span>
                                    </div>
                                    <p class="text-white font-semibold">{{ $trainer->jenis_kelamin }}</p>
                                </div>

                                <!-- Contract Status -->
                                <div class="bg-gray-700/50 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center gap-3 mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-400 text-sm">{{ __('Status') }}</span>
                                    </div>
                                    <p class="text-green-400 font-semibold">{{ __('Active') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Contract Dates -->
                        <div class="space-y-4 mb-8">
                            <h3 class="text-xl font-bold text-white mb-4">{{ __('Contract Details') }}</h3>
                            
                            <div class="bg-gradient-to-br from-yellow-900/30 to-yellow-900/10 border border-yellow-600/40 rounded-xl p-6">
                                <div class="flex items-start gap-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="flex-grow">
                                        <p class="text-yellow-300 text-sm mb-2">{{ __('Contract Expiration') }}</p>
                                        <p class="text-2xl font-bold text-white mb-1">
                                            {{ \Carbon\Carbon::parse($contract->tanggal_berakhir)->format('d M Y') }}
                                        </p>
                                        <p class="text-yellow-400 text-sm font-semibold">
                                            @php
                                                $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($contract->tanggal_berakhir));
                                            @endphp
                                            {{ $daysRemaining }} {{ __('days remaining') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('member.jadwal') }}" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ __('View Schedule') }}
                            </a>

                            <a href="{{ route('member.trainer') }}" class="flex-1 px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                {{ __('Change Trainer') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Info Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Membership Status -->
                <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-xl border border-blue-700 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        <h3 class="text-lg font-bold text-white">{{ __('Your Status') }}</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="bg-blue-700/50 rounded-lg p-3 border border-blue-600">
                            <p class="text-blue-300 text-xs mb-1">{{ __('Role') }}</p>
                            <p class="text-white font-semibold">
                                @if(Auth::user()->role === 'MEMBER')
                                    {{ __('Member') }}
                                @else
                                    {{ Auth::user()->role }}
                                @endif
                            </p>
                        </div>

                        <div class="bg-blue-700/50 rounded-lg p-3 border border-blue-600">
                            <p class="text-blue-300 text-xs mb-1">{{ __('Trainer Contract') }}</p>
                            <p class="text-green-400 font-semibold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Active') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Helpful Tips -->
                <div class="bg-gradient-to-br from-purple-900/30 to-purple-900/10 rounded-xl border border-purple-600/40 p-6">
                    <div class="flex items-start gap-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 9a1 1 0 100-2 1 1 0 000 2zm5-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-lg font-bold text-purple-300">{{ __('Tips') }}</h3>
                    </div>

                    <ul class="space-y-2 text-sm text-purple-200">
                        <li class="flex items-start gap-2">
                            <span class="text-purple-400 font-bold mt-0.5">•</span>
                            <span>{{ __('Contact your trainer regularly for personalized coaching') }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-purple-400 font-bold mt-0.5">•</span>
                            <span>{{ __('Check your training schedule to stay on track') }}</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-purple-400 font-bold mt-0.5">•</span>
                            <span>{{ __('Renew your contract before expiration date') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
