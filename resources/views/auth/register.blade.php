<x-layout title="Register">

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf
        <h2 class="text-white text-3xl font-bold mb-6 text-center">Register</h2>

        <!-- Username -->
        <div>
            <input name="username" type="text" placeholder="Username" value="{{ old('username') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('username')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <input name="email" type="email" placeholder="Email" value="{{ old('email') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <input name="password" type="password" placeholder="Password"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <input name="password_confirmation" type="password" placeholder="Confirm Password"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>

        <!-- Phone Number -->
        <div>
            <input name="phone_number" type="text" placeholder="Phone Number" value="{{ old('phone_number') }}"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gender Select -->
        <div>
            <select name="gender"
                class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Gender</option>
                <option value="MALE" {{ old('gender') == 'MALE' ? 'selected' : '' }}>Male</option>
                <option value="FEMALE" {{ old('gender') == 'FEMALE' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
            Register
        </button>

</x-layout>
