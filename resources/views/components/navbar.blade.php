<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM BY YAPPING CLUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        /* Animasi underline halus */
        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }
        .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0%;
            height: 2px;
            background-color: #fff;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">

    <header class="flex justify-between items-center px-8 py-4 bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
        <!-- Kiri: Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/logo/logo_white.png') }}" alt="YAPPFIT GYM" class="w-16 h-16">
        </div>

        <!-- Tengah kosong -->
        <div class="flex-1"></div>

        <!-- Kanan: Language, Cart, dan Auth -->
        <div class="flex items-center gap-6">
            <!-- Language Switch -->
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M2 12h20"></path>
                    <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10A15.3 15.3 0 018 12 15.3 15.3 0 0112 2"></path>
                </svg>

                @php $current = app()->getLocale(); @endphp
                <form action="{{ route('lang.switch.post') }}" method="POST" id="langForm">
                    @csrf
                    <select name="locale" onchange="document.getElementById('langForm').submit()"
                        class="bg-gray-800 text-gray-300 text-sm border border-gray-600 rounded px-2 py-1 focus:outline-none">
                        <option value="en" {{ $current === 'en' ? 'selected' : '' }}>English</option>
                        <option value="id" {{ $current === 'id' ? 'selected' : '' }}>Bahasa Indonesia</option>
                    </select>
                </form>
            </div>

            <!-- Cart Icon -->
            <a href="#" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 hover:text-white transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 01-8 0"></path>
                </svg>
            </a>

            <!-- Auth Links -->
            @guest
                <div class="flex items-center gap-2">
                    <a href="{{ route('register') }}" class="nav-link text-sm text-gray-300 hover:text-white">{{ __('Register') }}</a>
                    <span class="text-gray-500">|</span>
                    <a href="{{ route('login') }}" class="nav-link text-sm text-gray-300 hover:text-white">{{ __('Log In') }}</a>
                </div>
            @else
                <!-- Dropdown User -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/images/default.png') }}"
                            alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-gray-700">
                        <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.outside="open = false"
                        class="absolute right-0 mt-2 w-40 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95">
                        
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 rounded-t-lg">
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 rounded-b-lg">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </header>

</body>
</html>