<x-layout title="{{ __('Register') }}">

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
    <h2 class="text-white text-3xl font-bold mb-6 text-center">{{ __('Register') }}</h2>

        <!-- Username -->
        <div>
            <input name="name" type="text" placeholder="{{ __('Username') }}" value="{{ old('name') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <input name="email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}"
                id="email"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <p id="email_warning" class="text-red-500 text-xs mt-1 hidden">{{ __('Email must contain @') }}</p>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <input name="password" type="password" placeholder="{{ __('Password') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <input name="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Phone Number -->
        <div>
            <input name="phone_number" type="text" placeholder="{{ __('Phone Number') }}" value="{{ old('phone_number') }}"
                id="phone_number"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <p id="phone_warning" class="text-red-500 text-xs mt-1 hidden">{{ __('Phone number must be between 10 and 12 digits') }}</p>
            @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gender Select -->
        <div>
                <select name="gender"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>{{ __('Gender') }}</option>
                <option value="LAKI-LAKI" {{ old('gender') == 'MALE' ? 'selected' : '' }}>{{ __('Male') }}</option>
                <option value="PEREMPUAN" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>{{ __('Female') }}</option>
            </select>
            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn"
            class="w-full py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
            Register
        </button>

    </form>

    <script>
        const phoneInput = document.getElementById('phone_number');
        const phoneWarning = document.getElementById('phone_warning');
        const emailInput = document.getElementById('email');
        const emailWarning = document.getElementById('email_warning');
        const submitBtn = document.getElementById('submitBtn');

        function validateForm() {
            const phoneValue = phoneInput.value.replace(/\D/g, '');
            const phoneLength = phoneValue.length;
            const emailValid = emailInput.value.includes('@');

            // Phone validation
            if (phoneLength > 0 && (phoneLength < 10 || phoneLength > 12)) {
                phoneWarning.classList.remove('hidden');
            } else {
                phoneWarning.classList.add('hidden');
            }

            // Email validation
            if (emailInput.value.length > 0 && !emailValid) {
                emailWarning.classList.remove('hidden');
            } else {
                emailWarning.classList.add('hidden');
            }

            // Submit button state
            const phoneInvalid = phoneLength > 0 && (phoneLength < 10 || phoneLength > 12);
            const emailInvalid = emailInput.value.length > 0 && !emailValid;

            if (phoneInvalid || emailInvalid) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
                submitBtn.style.cursor = 'not-allowed';
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                submitBtn.style.cursor = 'pointer';
            }
        }

        phoneInput.addEventListener('input', validateForm);
        emailInput.addEventListener('input', validateForm);

        // Validate on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const phoneValue = phoneInput.value.replace(/\D/g, '');
            const emailValid = emailInput.value.includes('@');

            if (phoneValue.length > 0 && (phoneValue.length < 10 || phoneValue.length > 12)) {
                e.preventDefault();
                alert('{{ __("Phone number must be between 10 and 12 digits") }}');
            }

            if (emailInput.value.length > 0 && !emailValid) {
                e.preventDefault();
                alert('{{ __("Email must contain @") }}');
            }
        });
    </script>

</x-layout>
