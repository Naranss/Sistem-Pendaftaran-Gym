<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold text-white mb-8">{{ __('About Yapping Club Gym') }}</h1>

            {{-- Mission Section --}}
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-white mb-4">{{ __('Our Mission') }}</h2>
                <p class="text-gray-300 leading-relaxed mb-6">
                    {{ __('At Yapping Club Gym, we are committed to helping our members achieve their fitness goals and lead healthier lives. Our mission is to provide a welcoming, motivating environment where people of all fitness levels can thrive and transform themselves.') }}
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-800 rounded-lg p-6">
                        <svg class="w-12 h-12 text-red-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">{{ __('Motivate') }}</h3>
                        <p class="text-gray-400">{{ __('We inspire our members to push their limits and achieve more than they thought possible.') }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-6">
                        <svg class="w-12 h-12 text-red-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">{{ __('Educate') }}</h3>
                        <p class="text-gray-400">{{ __('We provide expert guidance and knowledge to help members make informed fitness decisions.') }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-6">
                        <svg class="w-12 h-12 text-red-500 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">{{ __('Support') }}</h3>
                        <p class="text-gray-400">{{ __('We create a supportive community where everyone feels welcome and encouraged.') }}</p>
                    </div>
                </div>
            </section>

            {{-- Facilities Section --}}
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-white mb-4">{{ __('Our Facilities') }}</h2>
                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('State-of-the-art equipment') }}
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Spacious workout areas') }}
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Cardio zone') }}
                            </li>
                        </ul>
                        <ul class="space-y-3">
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Personal training area') }}
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Locker rooms & showers') }}
                            </li>
                            <li class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-3 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Supplement store') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            {{-- Contact Section --}}
            <section class="mb-12">
                <h2 class="text-2xl font-semibold text-white mb-4">{{ __('Contact Us') }}</h2>
                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-4">{{ __('Location') }}</h3>
                            <p class="text-gray-400 mb-2">Jl. Papper No. 20</p>
                            <p class="text-gray-400 mb-2">Jakarta, Indonesia</p>
                            <p class="text-gray-400">12345</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-4">{{ __('Hours') }}</h3>
                            <p class="text-gray-400 mb-2">{{ __('Monday - Friday: 6:00 - 22:00') }}</p>
                            <p class="text-gray-400 mb-2">{{ __('Saturday: 7:00 - 20:00') }}</p>
                            <p class="text-gray-400">{{ __('Sunday: 8:00 - 18:00') }}</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Call to Action --}}
            <div class="text-center">
                <p class="text-lg text-gray-300 mb-6">{{ __('Ready to start your fitness journey with us?') }}</p>
                <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                    {{ __('Join Now') }}
                </a>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />