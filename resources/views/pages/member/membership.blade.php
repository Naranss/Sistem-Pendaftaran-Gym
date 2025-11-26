<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Membership Plans') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Choose the perfect plan for your fitness journey') }}</p>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-900/30 to-green-900/10 border border-green-500/40 rounded-xl p-4 mb-8 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-300">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40 rounded-xl p-4 mb-8 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-300">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Current Membership Status --}}
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8 mb-12">
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 000-2H5a1 1 0 00-1 1v1H3a1 1 0 000 2h1v1a1 1 0 002 0V4h1a1 1 0 000-2H6V2a1 1 0 01-1-1zm0 0a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 4a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2V8a2 2 0 00-2-2H5z" />
                </svg>
                <h2 class="text-2xl font-bold text-white">{{ __('Your Current Status') }}</h2>
            </div>
            
            @if($akun)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Status --}}
                    <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                        <p class="text-gray-400 text-sm mb-2">{{ __('Status') }}</p>
                        <p class="text-2xl font-bold 
                            @if($status_membership === 'aktif') text-green-400
                            @elseif($status_membership === 'expired') text-red-400
                            @else text-gray-400
                            @endif
                            flex items-center gap-2">
                            @if($status_membership === 'aktif')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Active') }}
                            @elseif($status_membership === 'expired')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Expired') }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13 6a1 1 0 11-2 0 1 1 0 012 0zM7 9a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0zM9 15a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Inactive') }}
                            @endif
                        </p>
                    </div>

                    {{-- Start Date --}}
                    @if($akun->membership_start)
                        <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                            <p class="text-gray-400 text-sm mb-2">{{ __('Start Date') }}</p>
                            <p class="text-lg font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($akun->membership_start)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    {{-- End Date --}}
                    @if($akun->membership_end)
                        <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                            <p class="text-gray-400 text-sm mb-2">{{ __('End Date') }}</p>
                            <p class="text-lg font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($akun->membership_end)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    {{-- Days Remaining --}}
                    @if($status_membership === 'aktif' && $akun->membership_end)
                        <div class="bg-gradient-to-br from-yellow-900/30 to-yellow-900/10 rounded-lg p-4 border border-yellow-600/40">
                            <p class="text-gray-400 text-sm mb-2">{{ __('Days Remaining') }}</p>
                            <p class="text-2xl font-bold text-yellow-400 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($akun->membership_end)) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ __('days') }}</p>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-gray-400">{{ __('No membership information found.') }}</p>
            @endif
        </div>

        {{-- Membership Plans --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                </svg>
                <h2 class="text-2xl font-bold text-white">{{ __('Choose Your Plan') }}</h2>
            </div>
            
            <form action="{{ route('member.membership.update') }}" method="POST" id="membershipForm">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    {{-- Monthly Plan --}}
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-red-600/50 transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                         data-membership="bulanan" 
                         data-price="300000">
                        <div class="p-6 h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">{{ __('Monthly') }}</h3>
                                <div class="text-3xl font-bold text-red-500 mb-6">
                                    Rp 300.000
                                    <span class="text-sm text-gray-400 font-normal block">/bulan</span>
                                </div>
                                <ul class="space-y-2 mb-6 text-sm text-gray-300">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Access to all equipment') }}
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Locker access') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="border-2 border-transparent rounded-lg p-3 text-center membership-selected hidden bg-green-900/30 border-green-500/50">
                                <div class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-green-400 font-semibold">{{ __('Selected') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3 Months Plan --}}
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl overflow-hidden shadow-lg border-2 border-red-500 transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                         data-membership="per3bulan" 
                         data-price="800000">
                        <div class="bg-gradient-to-r from-red-600 to-red-700 text-white text-center py-2 font-bold text-sm flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            {{ __('Best Value') }}
                        </div>
                        <div class="p-6 h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">{{ __('3 Months') }}</h3>
                                <div class="text-3xl font-bold text-red-500 mb-2">
                                    Rp 800.000
                                    <span class="text-sm text-gray-400 font-normal block">/3 bulan</span>
                                </div>
                                <p class="text-xs text-green-400 font-semibold mb-6">{{ __('Hemat Rp 100.000') }}</p>
                                <ul class="space-y-2 mb-6 text-sm text-gray-300">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('All monthly features') }}
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Priority support') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="border-2 border-transparent rounded-lg p-3 text-center membership-selected hidden bg-green-900/30 border-green-500/50">
                                <div class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-green-400 font-semibold">{{ __('Selected') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Yearly Plan --}}
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-red-600/50 transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                         data-membership="tahunan" 
                         data-price="3000000">
                        <div class="p-6 h-full flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-3">{{ __('Yearly') }}</h3>
                                <div class="text-3xl font-bold text-red-500 mb-6">
                                    Rp 3.000.000
                                    <span class="text-sm text-gray-400 font-normal block">/tahun</span>
                                </div>
                                <ul class="space-y-2 mb-6 text-sm text-gray-300">
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('All features included') }}
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Save Rp 600.000') }}
                                    </li>
                                </ul>
                            </div>
                            <div class="border-2 border-transparent rounded-lg p-3 text-center membership-selected hidden bg-green-900/30 border-green-500/50">
                                <div class="flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-green-400 font-semibold">{{ __('Selected') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="membership" id="membership_type" required>
                <input type="hidden" name="harga_membership" id="harga_membership" required>

                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8 mb-8">
                    <div class="flex items-center gap-3 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        <h3 class="text-xl font-bold text-white">{{ __('Payment Method') }}</h3>
                    </div>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer p-3 rounded-lg hover:bg-gray-700/50 transition border border-gray-600 hover:border-red-600/50">
                            <input type="radio" name="metode_pembayaran" value="transfer" class="w-4 h-4 mr-3" checked>
                            <div class="flex-grow">
                                <span class="text-white font-semibold">{{ __('Bank Transfer') }}</span>
                                <p class="text-xs text-gray-400">{{ __('Fastest and most secure') }}</p>
                            </div>
                        </label>
                        <label class="flex items-center cursor-pointer p-3 rounded-lg hover:bg-gray-700/50 transition border border-gray-600 hover:border-red-600/50">
                            <input type="radio" name="metode_pembayaran" value="cash" class="w-4 h-4 mr-3">
                            <div class="flex-grow">
                                <span class="text-white font-semibold">{{ __('Cash') }}</span>
                                <p class="text-xs text-gray-400">{{ __('Pay at the gym') }}</p>
                            </div>
                        </label>
                        <label class="flex items-center cursor-pointer p-3 rounded-lg hover:bg-gray-700/50 transition border border-gray-600 hover:border-red-600/50">
                            <input type="radio" name="metode_pembayaran" value="e-wallet" class="w-4 h-4 mr-3">
                            <div class="flex-grow">
                                <span class="text-white font-semibold">{{ __('E-Wallet') }}</span>
                                <p class="text-xs text-gray-400">{{ __('GCash, PayMaya, etc.') }}</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg flex items-center justify-center gap-2"
                            id="submitBtn"
                            disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        {{ __('Upgrade Membership') }}
                    </button>
                    <a href="{{ route('member.keranjang') }}" 
                       class="px-8 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white rounded-lg font-bold transition duration-300 shadow-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Back') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const membershipCards = document.querySelectorAll('.membership-card');
        const membershipTypeInput = document.getElementById('membership_type');
        const hargaMembershipInput = document.getElementById('harga_membership');
        const submitBtn = document.getElementById('submitBtn');

        membershipCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                membershipCards.forEach(c => {
                    c.classList.remove('border-green-500');
                    c.querySelector('.membership-selected').classList.add('hidden');
                });

                // Add selected class to clicked card
                this.classList.add('border-green-500');
                this.querySelector('.membership-selected').classList.remove('hidden');

                // Set form values
                membershipTypeInput.value = this.dataset.membership;
                hargaMembershipInput.value = this.dataset.price;

                // Enable submit button
                submitBtn.disabled = false;
            });
        });
    });
</script>

