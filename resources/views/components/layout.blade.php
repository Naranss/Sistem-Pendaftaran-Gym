<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'YAPPFIT GYM' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <style>
        body {
            background-image: url("{{ asset('assets/background/background.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center relative">

    @if(isset($title) && $title === 'Chat Room')
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>
        <div class="relative z-10 w-full min-h-screen flex items-stretch justify-center">
            {{ $slot }}
        </div>
    @else
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-70"></div>

        <!-- Container -->
        <div class="relative z-10 w-full max-w-md p-8 bg-[#0b132b]/90 rounded-2xl shadow-2xl flex flex-col items-center">
            <!-- Logo -->
            <div class="mb-2">
                <img src="{{ asset('assets/logo/logo_white.png') }}" alt="YAPPFIT GYM Logo" class="w-52 mx-auto">
            </div>

            <!-- Slot Form -->
            <div class="w-full mt-1">
                {{ $slot }}
            </div>

        </div>
    @endif

</body>

</html>