<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.107a1.533 1.533 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.107-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.107a1.534 1.534 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Profile Settings') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Manage your account information and preferences') }}</p>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
        <div class="bg-gradient-to-r from-green-900/30 to-green-900/10 border border-green-500/40 rounded-xl p-4 mb-8 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            <span class="text-green-300">{{ session('success') }}</span>
        </div>
        @endif

        @if ($errors->any())
        <div class="bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40 rounded-xl p-4 mb-8">
            <div class="flex gap-3 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-300 font-semibold">{{ __('Please fix the errors below:') }}</span>
            </div>
            <ul class="space-y-1 ml-8">
                @foreach ($errors->all() as $error)
                <li class="text-red-300 text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8 sticky top-4">
                    <div class="text-center">
                        <!-- Profile Photo -->
                        <div class="relative mx-auto mb-6 w-fit">
                            <img id="photoPreview"
                                src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->nama ?? Auth::user()->email }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-red-600 shadow-lg">
                            <label for="photo" class="absolute bottom-2 right-2 bg-red-600 hover:bg-red-700 rounded-full p-3 cursor-pointer transition shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                        </div>

                        <h2 class="text-2xl font-bold text-white mb-1">{{ Auth::user()->nama ?? Auth::user()->email }}</h2>
                        <p class="text-gray-400 text-sm mb-4">{{ Auth::user()->role }}</p>

                        <!-- Role Badge -->
                        <div class="mb-6">
                            <span class="inline-block px-4 py-2 bg-red-600/20 border border-red-500/50 rounded-full text-red-400 text-xs font-bold uppercase">
                                @if(Auth::user()->role === 'MEMBER')
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v1h8v-1zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                </svg>
                                {{ __('Member') }}
                                @elseif(Auth::user()->role === 'TRAINER')
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Trainer') }}
                                @elseif(Auth::user()->role === 'PENGUNJUNG')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                    {{ __('Visitor') }}
                                @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M17.778 8.222c-4.296-4.296-11.26-4.296-15.556 0A1 1 0 01.808 6.808c4.76-4.76 12.427-4.76 17.186 0a1 1 0 01-1.414 1.414zM14.95 11.05a7 7 0 00-9.9 0 1 1 0 01-1.414-1.414 9 9 0 0112.728 0 1 1 0 01-1.414 1.414zM12.12 13.88a3 3 0 00-4.242 0 1 1 0 01-1.415-1.415 5 5 0 017.072 0 1 1 0 01-1.415 1.415zM9 16a1 1 0 011-1h0a1 1 0 011 1v0a1 1 0 01-1 1h0a1 1 0 01-1-1v0z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Admin') }}
                                @endif
                            </span>
                        </div>

                        <!-- Membership Status (if member) -->
                        @if(Auth::user()->role === 'MEMBER' && Auth::user()->membership_end)
                        <div class="bg-gray-700/50 rounded-lg p-4 mb-6">
                            <p class="text-gray-400 text-xs mb-2">{{ __('Membership Status') }}</p>
                            <p class="text-lg font-bold
                                    @if(\Carbon\Carbon::now()->isBefore(Auth::user()->membership_end)) text-green-400
                                    @else text-red-400
                                    @endif">
                                @if(\Carbon\Carbon::now()->isBefore(Auth::user()->membership_end))
                                ✓ {{ __('Active') }}
                                @else
                                ✗ {{ __('Expired') }}
                                @endif
                            </p>
                            <p class="text-gray-400 text-xs mt-2">
                                {{ \Carbon\Carbon::parse(Auth::user()->membership_end)->format('d M Y') }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="lg:col-span-2">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <input type="file" id="photo" name="photo" class="hidden" accept="image/*">

                    <!-- Personal Information Section -->
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-xl font-bold text-white">{{ __('Personal Information') }}</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('Full Name') }}
                                </label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', Auth::user()->nama) }}"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('Email Address') }}
                                </label>
                                <input type="email" name="email" id="email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                @error('email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('Phone Number') }}
                                </label>
                                <input type="tel" name="phone" id="phone"
                                    value="{{ old('phone', Auth::user()->no_telp) }}"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                @error('phone')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Password Change Section -->
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            <h3 class="text-xl font-bold text-white">{{ __('Change Password') }}</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('Current Password') }}
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                @error('current_password')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('New Password') }}
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                                @error('password')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                                    {{ __('Confirm New Password') }}
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full rounded-lg bg-gray-700 border border-gray-600 text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            {{ __('Save Changes') }}
                        </button>
                        <a href="{{ route('homepage') }}"
                            class="px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white rounded-lg font-bold transition duration-300 shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Back') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script>
    // Handle photo upload and preview
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file size (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('{{ __("File size must be less than 2MB") }}');
                e.target.value = '';
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('{{ __("Please select an image file") }}');
                e.target.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('photoPreview').src = event.target.result;
            };
            reader.readAsDataURL(file);

            // Create FormData with only the photo
            const formData = new FormData();
            formData.append('photo', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            formData.append('_method', 'PUT');

            // Show loading state
            const photoInput = e.target;
            photoInput.disabled = true;

            // Submit photo upload via AJAX
            fetch('{{ route("profile.update") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    photoInput.disabled = false;

                    if (data.success) {
                        console.log('Photo uploaded successfully');
                        // Show success message at top
                        location.reload();
                    } else {
                        console.error('Upload failed:', data);
                        alert(data.message || '{{ __("Failed to upload photo") }}');
                        e.target.value = '';
                    }
                })
                .catch(error => {
                    photoInput.disabled = false;
                    console.error('Error:', error);
                    alert('{{ __("Error uploading photo. Please try again.") }}');
                    e.target.value = ''; // Clear the file input
                });
        }
    });
</script>