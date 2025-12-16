<x-layout title="Login">

    {{-- Notifikasi Sukses --}}
    @if (session()->has('success'))
        <div class="mb-6 p-4 rounded-lg bg-gradient-to-r from-green-900/30 to-green-900/10 border border-green-500/40 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="text-green-300 font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if (session()->has('loginError'))
        <div class="mb-6 p-4 rounded-lg bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
            <span class="text-red-300 font-medium">{{ session('loginError') }}</span>
        </div>
    @endif

    {{-- Form Login --}}
    <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf
        <h2 class="text-white text-3xl font-bold text-center">{{__('Login')}}</h2>

        <!-- Email Field -->
        <div>
            <input name="email" type="email" placeholder="{{__('Email')}}" value="{{ old('email') }}"
                id="email"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('email') ring-2 ring-red-500 @enderror"
                required>
            @error('email')
                <p class="text-red-400 text-xs mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Field -->
        <div>
            <input name="password" type="password" placeholder="{{__('Password')}}"
                id="password"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('password') ring-2 ring-red-500 @enderror"
                required>
            @error('password')
                <p class="text-red-400 text-xs mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <button type="submit" id="submitBtn"
            class="w-full py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
            {{__('Login')}}
        </button>

        <div class="text-gray-300 mt-4 text-sm text-center space-y-2">
            <div>
                <a href="{{ route('password.request') }}" class="hover:text-yellow-400 hover:underline transition">{{__('Forgot Password?')}}</a>
            </div>
            <div>
                {{__("Don't have an account?")}}
                <a href="{{ route('register') }}" class="font-bold hover:underline text-yellow-400 hover:text-yellow-300 transition">{{__('Register Now')}}</a>
            </div>
        </div>
    </form>

    <script>
        // Validasi form
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!email || !password) {
                e.preventDefault();
                alert('{{ __("Please fill in all fields") }}');
            }
        });

        // Clear errors on input
        document.getElementById('email').addEventListener('input', function() {
            this.classList.remove('ring-2', 'ring-red-500');
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('ring-2', 'ring-red-500');
        });
    </script>

</x-layout>