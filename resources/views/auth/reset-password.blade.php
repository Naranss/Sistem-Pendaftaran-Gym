<x-layout title="Reset Password">

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40">
            <div class="flex gap-3 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-300 font-semibold">{{ __('Validation failed') }}</span>
            </div>
            <ul class="space-y-1 ml-8">
                @foreach ($errors->all() as $error)
                <li class="text-red-300 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Reset Password Form --}}
    <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="text-center mb-6">
            <h2 class="text-white text-3xl font-bold mb-2">{{__('Reset Password')}}</h2>
            <p class="text-gray-400 text-sm">{{__('Enter your new password below')}}</p>
        </div>

        <!-- New Password Field -->
        <div>
            <label for="password" class="block text-gray-300 text-sm font-medium mb-2">{{__('New Password')}}</label>
            <input name="password" type="password" id="password" placeholder="{{__('Enter new password')}}"
                class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('password') ring-2 ring-red-500 @enderror"
                required>
            <p class="text-gray-400 text-xs mt-1">{{__('Minimum 8 characters')}}</p>
            @error('password')
                <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div>
            <label for="password_confirmation" class="block text-gray-300 text-sm font-medium mb-2">{{__('Confirm Password')}}</label>
            <input name="password_confirmation" type="password" id="password_confirmation" placeholder="{{__('Confirm new password')}}"
                class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('password_confirmation') ring-2 ring-red-500 @enderror"
                required>
            @error('password_confirmation')
                <p class="text-red-400 text-xs mt-2 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password Match Validation -->
        <div id="passwordMatch" class="hidden p-3 rounded-lg bg-yellow-900/20 border border-yellow-500/40 text-yellow-300 text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{__('Passwords do not match')}}
        </div>

        <button type="submit" id="submitBtn" class="w-full py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            {{__('Reset Password')}}
        </button>

        <div class="text-gray-300 mt-6 text-sm text-center">
            {{__('Remember your password?')}}
            <a href="{{ route('login') }}" class="font-bold hover:underline text-yellow-400 hover:text-yellow-300 transition">{{__('Login')}}</a>
        </div>
    </form>

    <script>
        const password = document.getElementById('password');
        const confirmation = document.getElementById('password_confirmation');
        const matchWarning = document.getElementById('passwordMatch');
        const submitBtn = document.getElementById('submitBtn');

        function validatePasswords() {
            if (password.value && confirmation.value) {
                if (password.value !== confirmation.value) {
                    matchWarning.classList.remove('hidden');
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                    submitBtn.style.cursor = 'not-allowed';
                } else {
                    matchWarning.classList.add('hidden');
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                }
            }
        }

        password.addEventListener('input', validatePasswords);
        confirmation.addEventListener('input', validatePasswords);

        document.querySelector('form').addEventListener('submit', function(e) {
            if (password.value !== confirmation.value) {
                e.preventDefault();
                alert('{{ __("Passwords do not match") }}');
            }
            if (password.value.length < 8) {
                e.preventDefault();
                alert('{{ __("Password must be at least 8 characters") }}');
            }
        });
    </script>

</x-layout>
