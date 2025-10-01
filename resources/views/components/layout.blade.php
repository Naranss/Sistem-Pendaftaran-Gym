<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'YAPPFIT GYM' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 flex items-center justify-center relative">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>

    <!-- Container -->
    <div class="relative z-10 w-full max-w-md p-8 bg-gray-900 bg-opacity-95 rounded-2xl shadow-2xl flex flex-col items-center">

        <!-- Logo -->
        <div class="mb-4"> 
            <img src="{{ asset('assets/logo/logo_white.png') }}" alt="YAPPFIT GYM Logo" class="w-52 mx-auto">
        </div>

        <!-- Slot Form -->
        <div class="w-full">
            {{ $slot }}
        </div>

    </div>

</body>

</html>