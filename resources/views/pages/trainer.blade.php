<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Our Professional Trainers') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Get expert guidance from our experienced fitness professionals') }}</p>
        </div>

        @if($trainers->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($trainers as $trainer)
                    <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-700 hover:border-red-600/50 group">
                        <!-- Image -->
                        <div class="relative h-64 bg-gradient-to-br from-gray-700 to-gray-900 overflow-hidden flex items-center justify-center">
                            <img src="{{ $trainer->profile_photo_url ?? asset('assets/trainers/trainer-default.jpg') }}" alt="{{ $trainer->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="text-2xl font-bold text-white mb-1 group-hover:text-red-400 transition">{{ $trainer->nama }}</h3>
                                <p class="text-red-500 font-semibold text-sm">{{ __('Professional Trainer') }}</p>
                            </div>

                            <!-- Contact Info -->
                            <div class="space-y-2 border-t border-b border-gray-700 py-4">
                                <div class="flex items-center gap-3 text-gray-300">
                                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">{{ $trainer->email }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-300">
                                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-sm">{{ $trainer->no_telp }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-300">
                                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                    <span class="text-sm">{{ $trainer->jenis_kelamin }}</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            @auth
                                <a href="{{ route('guest.trainer.contract', $trainer->id) }}" class="w-full inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 py-3 rounded-lg font-bold transition duration-300 text-center shadow-md">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" /></svg>
                                    {{ __('Contract Trainer') }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="w-full inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 py-3 rounded-lg font-bold transition duration-300 text-center shadow-md">
                                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3h2a1 1 0 011 1v10a1 1 0 01-1 1H3a1 1 0 01-1-1v-3H1a1 1 0 01-1-1V6a1 1 0 011-1h2V3z" clip-rule="evenodd" /></svg>
                                    {{ __('Login to Contract') }}
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700 mb-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2-1m2 1l-2 1m2-1v2.5M14 4l-2-1-2 1m2 1l2 1m-2-1L8 5m2 1l2-1m0 0V3.5M14 20l-2-1m2 1l-2 1m2-1v-2.5M20 17l-2-1m2 1l-2-1m2 1v-2.5M14 16l-2-1-2 1m2-1l2 1m-2-1l-2-1" />
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Trainers Available') }}</h3>
                <p class="text-gray-400 mb-6">{{ __('Check back soon for our trainer roster') }}</p>
            </div>
        @endif

        <!-- Call to Action (Only for Guests) -->
        @guest
        <div class="bg-gradient-to-r from-red-900/40 to-red-900/20 border border-red-500/30 rounded-xl p-8 text-center">
            <h2 class="text-2xl font-bold text-white mb-3">{{ __('Ready to Transform Your Fitness?') }}</h2>
            <p class="text-gray-300 mb-6">{{ __('Contract a professional trainer and start your personalized fitness journey today!') }}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                    {{ __('Register Now') }}
                </a>
                <a href="{{ route('suplemen') }}" class="inline-block bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                    {{ __('Browse Supplements') }}
                </a>
            </div>
        </div>
        @endguest
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
