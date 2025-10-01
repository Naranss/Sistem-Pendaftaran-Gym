<x-layout title="">

    {{-- Notifikasi Sukses --}}
    @if (session()->has('success'))
        <div class="mb-4 p-3 rounded bg-green-500 text-white text-sm text-center">
            {{ session('success') }}
        </div>
    @endif

    {{-- Notifikasi Error --}}
    @if (session()->has('loginError'))
        <div class="mb-4 p-3 rounded bg-red-600 text-white text-sm text-center">
            {{ session('loginError') }}
        </div>
    @endif

    {{-- Form Login --}}
    <form method="POST" action="{{ route('login-auth') }}" class="space-y-4">
        @csrf
        <h2 class="text-white text-3xl font-bold text-center">Login</h2>

        <input name="username" type="text" placeholder="Username"
            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">

        <input name="password" type="password" placeholder="Password"
            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">

        <button type="submit"
            class="w-full py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
            Login
        </button>

        <div class="text-gray-300 mt-4 text-sm text-center space-y-1">
            <a href="#" class="hover:underline">Forgot Password?</a><br>
            Don’t have an account?
            <a href="{{ route('register') }}" class="font-bold hover:underline text-yellow-400">Register Now</a>
        </div>
    </form>

</x-auth-layout>