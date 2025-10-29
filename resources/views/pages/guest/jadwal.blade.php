<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Class Schedule') }}</h1>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-7 gap-4">
                    {{-- Monday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Monday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-500 pl-3">
                                <p class="text-white font-medium">6:00 - 7:30</p>
                                <p class="text-gray-400">Morning Yoga</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-3">
                                <p class="text-white font-medium">8:00 - 9:30</p>
                                <p class="text-gray-400">HIIT Training</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-3">
                                <p class="text-white font-medium">18:00 - 19:30</p>
                                <p class="text-gray-400">Strength Training</p>
                            </div>
                        </div>
                    </div>

                    {{-- Tuesday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Tuesday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-purple-500 pl-3">
                                <p class="text-white font-medium">7:00 - 8:30</p>
                                <p class="text-gray-400">Pilates</p>
                            </div>
                            <div class="border-l-4 border-yellow-500 pl-3">
                                <p class="text-white font-medium">9:00 - 10:30</p>
                                <p class="text-gray-400">Cardio Blast</p>
                            </div>
                            <div class="border-l-4 border-pink-500 pl-3">
                                <p class="text-white font-medium">17:00 - 18:30</p>
                                <p class="text-gray-400">Zumba</p>
                            </div>
                        </div>
                    </div>

                    {{-- Wednesday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Wednesday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-500 pl-3">
                                <p class="text-white font-medium">6:00 - 7:30</p>
                                <p class="text-gray-400">CrossFit</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-3">
                                <p class="text-white font-medium">8:00 - 9:30</p>
                                <p class="text-gray-400">Boxing</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-3">
                                <p class="text-white font-medium">18:00 - 19:30</p>
                                <p class="text-gray-400">Core Training</p>
                            </div>
                        </div>
                    </div>

                    {{-- Thursday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Thursday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-purple-500 pl-3">
                                <p class="text-white font-medium">7:00 - 8:30</p>
                                <p class="text-gray-400">Spinning</p>
                            </div>
                            <div class="border-l-4 border-yellow-500 pl-3">
                                <p class="text-white font-medium">9:00 - 10:30</p>
                                <p class="text-gray-400">Body Pump</p>
                            </div>
                            <div class="border-l-4 border-pink-500 pl-3">
                                <p class="text-white font-medium">17:00 - 18:30</p>
                                <p class="text-gray-400">Kickboxing</p>
                            </div>
                        </div>
                    </div>

                    {{-- Friday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Friday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-500 pl-3">
                                <p class="text-white font-medium">6:00 - 7:30</p>
                                <p class="text-gray-400">Yoga Flow</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-3">
                                <p class="text-white font-medium">8:00 - 9:30</p>
                                <p class="text-gray-400">HIIT & Core</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-3">
                                <p class="text-white font-medium">18:00 - 19:30</p>
                                <p class="text-gray-400">Dance Fitness</p>
                            </div>
                        </div>
                    </div>

                    {{-- Saturday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Saturday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-purple-500 pl-3">
                                <p class="text-white font-medium">8:00 - 9:30</p>
                                <p class="text-gray-400">Weekend Warrior</p>
                            </div>
                            <div class="border-l-4 border-yellow-500 pl-3">
                                <p class="text-white font-medium">10:00 - 11:30</p>
                                <p class="text-gray-400">Power Yoga</p>
                            </div>
                            <div class="border-l-4 border-pink-500 pl-3">
                                <p class="text-white font-medium">15:00 - 16:30</p>
                                <p class="text-gray-400">Stretch & Relax</p>
                            </div>
                        </div>
                    </div>

                    {{-- Sunday --}}
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h3 class="text-xl font-semibold text-white mb-4">{{ __('Sunday') }}</h3>
                        <div class="space-y-3">
                            <div class="border-l-4 border-red-500 pl-3">
                                <p class="text-white font-medium">9:00 - 10:30</p>
                                <p class="text-gray-400">Meditation & Yoga</p>
                            </div>
                            <div class="border-l-4 border-blue-500 pl-3">
                                <p class="text-white font-medium">11:00 - 12:30</p>
                                <p class="text-gray-400">Full Body Workout</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-lg text-gray-400 mb-6">{{ __('Want to join our exciting classes?') }}</p>
            <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                {{ __('Register Now') }}
            </a>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />