<x-layout title="Login">

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
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <h2 class="text-white text-3xl font-bold text-center">{{__('Login')}}</h2>

        <input name="username" type="text" placeholder="{{__('Username')}}"
            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">

        <input name="password" type="password" placeholder="{{__('Password')}}"
            class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">

        <button type="submit"
            class="w-full py-2 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600 transition duration-300">
            {{__('Login')}}
        </button>

        <div class="text-gray-300 mt-4 text-sm text-center space-y-1">
            <a href="#" class="hover:underline">{{__('Forgot Password?')}}</a><br>
            {{__("Don't have an account?")}}
            <a href="{{ route('register') }}" class="font-bold hover:underline text-yellow-400">{{__('Register Now')}}</a>
        </div>
    </form>

</x-layout>