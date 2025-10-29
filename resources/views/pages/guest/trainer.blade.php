<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Our Professional Trainers') }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Sample trainer cards - Replace with actual trainer data --}}
            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/trainers/trainer1.jpg') }}" alt="Trainer 1" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">John Doe</h3>
                    <p class="text-gray-400 mb-4">Fitness & Strength Training Specialist</p>
                    <div class="flex items-center text-gray-500 mb-4">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>5+ years experience</span>
                    </div>
                    <p class="text-gray-400">Specializes in strength training and muscle building programs. Certified personal trainer with expertise in nutrition and recovery techniques.</p>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/trainers/trainer2.jpg') }}" alt="Trainer 2" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Jane Smith</h3>
                    <p class="text-gray-400 mb-4">Cardio & HIIT Specialist</p>
                    <div class="flex items-center text-gray-500 mb-4">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>7+ years experience</span>
                    </div>
                    <p class="text-gray-400">Expert in high-intensity interval training and cardio workouts. Helps clients achieve their weight loss and endurance goals.</p>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
                <img src="{{ asset('assets/trainers/trainer3.jpg') }}" alt="Trainer 3" class="w-full h-64 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">Mike Johnson</h3>
                    <p class="text-gray-400 mb-4">Yoga & Flexibility Expert</p>
                    <div class="flex items-center text-gray-500 mb-4">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>4+ years experience</span>
                    </div>
                    <p class="text-gray-400">Specialized in yoga, flexibility training, and mobility work. Helps clients improve their range of motion and reduce injury risk.</p>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-lg text-gray-400 mb-6">{{ __('Ready to start your fitness journey with our expert trainers?') }}</p>
            <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                {{ __('Join Now') }}
            </a>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />