<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM BY YAPPING CLUB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">

    <header class="flex justify-between items-center px-8 py-4 bg-black border-b border-gray-800">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/logo/logo_white.png') }}" alt="YAPPFIT GYM" class="w-12 h-12"> 
        </div>

        <div class="flex items-center gap-4">
            <div class="flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 0v20m0-20C7.58 2 4 6.48 4 12s3.58 10 8 10m0-20c4.42 0 8 4.48 8 10s-3.58 10-8 10" />
                </svg>
                <select class="bg-black text-white text-sm border border-gray-600 rounded px-2 py-1">
                    <option>English</option> 
                    <option>Bahasa Indonesia</option>
                </select>
            </div>

            @guest
                <a href="{{ route('register') }}" class="text-sm hover:underline">Register</a>
                <span>|</span>
                <a href="{{ route('login') }}" class="text-sm hover:underline">Log In</a>
            @else
                <div class="flex items-center gap-2">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('assets/images/default.png') }}" 
                         alt="Profile" class="w-10 h-10 rounded-full object-cover">
                    <span class="text-sm">{{ Auth::user()->name }}</span>
                </div>
            @endguest

            <a href="#" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m13-9l2 9m-5-9V5m0 0l-4 8" />
                </svg>
            </a>
        </div>
    </header>