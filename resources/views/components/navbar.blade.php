<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM BY YAPPING CLUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">

    <header class="flex justify-between items-center px-8 py-4 bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/logo/logo_white.png') }}" alt="YAPPFIT GYM" class="w-20 h-20">
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M2 12h20"></path>
                    <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10A15.3 15.3 0 018 12 15.3 15.3 0 0112 2"></path>
                </svg>
                <select class="bg-gray-800 text-gray-300 text-sm border border-gray-600 rounded px-2 py-1 focus:outline-none">
                    <option>English</option>
                    <option>Bahasa Indonesia</option>
                </select>
            </div>

            @guest
                <a href="{{ route('register') }}" class="text-sm text-gray-300 hover:text-white transition-colors duration-200">Register</a>
                <span class="text-gray-500">|</span>
                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white transition-colors duration-200">Log In</a>
            @else
                <div class="flex items-center gap-2">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/images/default.png') }}"
                         alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-gray-700">
                    <span class="text-sm text-gray-300">{{ Auth::user()->name }}</span>
                </div>
            @endguest

            <a href="#" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-300 hover:text-white transition-colors duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 01-8 0"></path>
                </svg>
            </a>
        </div>
    </header>

</body>
</html>