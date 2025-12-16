<x-layout title="Forgot Password">

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-lg bg-gradient-to-r from-green-900/30 to-green-900/10 border border-green-500/40 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="text-green-300 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div class="text-center mb-6">
            <h2 class="text-white text-3xl font-bold mb-2">{{__('Forgot Password?')}}</h2>
            <p class="text-gray-400 text-sm">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-gray-300 text-sm font-medium mb-2">{{__('Email Address')}}</label>
            <input name="email" type="email" id="email" placeholder="{{__('Enter your email')}}" value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('email') ring-2 ring-red-500 @enderror"
                required>
            @error('email')
                <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" class="w-full py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{__('Send Password Reset Link')}}
        </button>

        <div class="text-gray-300 mt-6 text-sm text-center">
            {{__('Remember your password?')}}
            <a href="{{ route('login') }}" class="font-bold hover:underline text-yellow-400 hover:text-yellow-300 transition">{{__('Login')}}</a>
        </div>
    </form>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            if (!email) {
                e.preventDefault();
                alert('{{ __("Please enter your email address") }}');
            }
        });

        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('ring-2', 'ring-red-500');
        });
    </script>

</x-layout>
