<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Membership Plans') }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Basic Plan --}}
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">{{ __('Basic Plan') }}</h2>
                    <div class="text-4xl font-bold text-red-500 mb-6">
                        Rp 300K
                        <span class="text-lg text-gray-400 font-normal">/month</span>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Access to gym equipment') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Locker access') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Basic fitness assessment') }}
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="block w-full text-center bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        {{ __('Get Started') }}
                    </a>
                </div>
            </div>

            {{-- Premium Plan --}}
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 border-2 border-red-500">
                <div class="bg-red-500 text-white text-center py-2">
                    {{ __('Most Popular') }}
                </div>
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">{{ __('Premium Plan') }}</h2>
                    <div class="text-4xl font-bold text-red-500 mb-6">
                        Rp 500K
                        <span class="text-lg text-gray-400 font-normal">/month</span>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('All Basic Plan features') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Personal trainer (2x/week)') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Access to all classes') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Nutrition consultation') }}
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="block w-full text-center bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        {{ __('Get Started') }}
                    </a>
                </div>
            </div>

            {{-- Elite Plan --}}
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-white mb-4">{{ __('Elite Plan') }}</h2>
                    <div class="text-4xl font-bold text-red-500 mb-6">
                        Rp 800K
                        <span class="text-lg text-gray-400 font-normal">/month</span>
                    </div>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('All Premium Plan features') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Personal trainer (4x/week)') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('VIP locker room') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Personalized meal plans') }}
                        </li>
                        <li class="flex items-center text-gray-300">
                            <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ __('Supplement consultation') }}
                        </li>
                    </ul>

                    <a href="{{ route('register') }}" class="block w-full text-center bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        {{ __('Get Started') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold text-white mb-6">{{ __('Frequently Asked Questions') }}</h2>
            <div class="space-y-6">
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Can I cancel my membership anytime?') }}</h3>
                    <p class="text-gray-400">{{ __('Yes, you can cancel your membership at any time. However, we require a 30-day notice for cancellation.') }}</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Are there any joining fees?') }}</h3>
                    <p class="text-gray-400">{{ __('No, there are no additional joining fees. You only pay the monthly membership fee for your chosen plan.') }}</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-white mb-2">{{ __('Can I freeze my membership?') }}</h3>
                    <p class="text-gray-400">{{ __('Yes, you can freeze your membership for up to 3 months per year with a valid reason (e.g., medical, travel).') }}</p>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />