<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-lg shadow-xl p-6 md:p-8">
            {{-- Header Section --}}
            <div class="border-b border-gray-700 pb-6 mb-6">
                <h1 class="text-2xl font-bold text-white mb-2">{{ __('Profile Settings') }}</h1>
                <p class="text-gray-400">{{ __('Manage your account information and settings') }}</p>
            </div>

            {{-- Profile Form --}}
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Profile Photo Section --}}
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 pb-6 border-b border-gray-700">
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/images/default.png') }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-gray-700">
                            <label for="photo" class="absolute bottom-0 right-0 bg-red-600 rounded-full p-2 cursor-pointer hover:bg-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <input type="file" id="photo" name="photo" class="hidden" accept="image/*">
                        </div>
                    </div>

                    <div class="flex-grow">
                        <h3 class="text-lg font-medium text-white">{{ __('Profile Photo') }}</h3>
                        <p class="text-sm text-gray-400">{{ __('Update your profile photo') }}</p>
                    </div>
                </div>

                {{-- Personal Information Section --}}
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">
                            {{ __('Full Name') }}
                        </label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', Auth::user()->name) }}"
                               class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">
                            {{ __('Email Address') }}
                        </label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', Auth::user()->email) }}"
                               class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300">
                            {{ __('Phone Number') }}
                        </label>
                        <input type="tel" name="phone" id="phone" 
                               value="{{ old('phone', Auth::user()->phone) }}"
                               class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-300">
                            {{ __('Address') }}
                        </label>
                        <textarea name="address" id="address" rows="3" 
                                  class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Password Change Section --}}
                <div class="pt-6 border-t border-gray-700">
                    <h3 class="text-lg font-medium text-white mb-4">{{ __('Change Password') }}</h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-300">
                                {{ __('Current Password') }}
                            </label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300">
                                {{ __('New Password') }}
                            </label>
                            <input type="password" name="password" id="password" 
                                   class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300">
                                {{ __('Confirm New Password') }}
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end pt-6">
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />