<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black">

    {{-- ================= Hero Section ================= --}}
    <section class="relative overflow-hidden bg-cover bg-center h-96" 
             style="background-image: url('{{ asset('assets/background/background.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>

        <div class="relative container mx-auto px-6 h-full flex items-center justify-center text-center">
            <div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-4 tracking-wider">
                    GYM BY YAPPING CLUB
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    {{ __('Your Journey to Fitness Starts Here') }}
                </p>

                @guest
                    <a href="{{ route('register') }}" 
                       class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                        {{ __('Start Your Journey') }}
                    </a>
                @endguest
            </div>
        </div>
    </section>

    {{-- ================= Categories Section ================= --}}
    <section class="container mx-auto px-6 py-12">
        <h2 class="text-2xl font-bold mb-6 text-white">
            {{ __('Categories') }}
        </h2>

        <div class="flex flex-wrap justify-start gap-10">

           {{-- ================= ADMIN ================= --}}
        @if(Auth::user() && Auth::user()->hasRole('ADMIN'))
            <x-category label="{{ __('Manage Supplements') }}" route="{{ route('admin.suplemen') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0-6.75h-3m3 0h3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Equipment') }}" route="{{ route('admin.alat-gym') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961M18 18.72a9.094 9.094 0 01-3.741-.479 3 3 0 01-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234M18 18.72a9.094 9.094 0 00-3.741-.479 3 3 0 00-4.682-2.72m.982 2.982c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234M6 18.72a9.094 9.094 0 01-3.741-.479 3 3 0 01-4.682-2.72m.982 2.982c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234M6 18.72a9.094 9.094 0 00-3.741-.479 3 3 0 00-4.682-2.72m.982 2.982c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Accounts') }}" route="{{ route('admin.akun') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663c.254.214.479.451.677.706" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Transactions') }}" route="{{ route('admin.transaksi') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                    </svg>
                </x-slot>
            </x-category>

        {{-- ================= TRAINER ================= --}}
        @elseif(Auth::user() && Auth::user()->hasRole('TRAINER'))
            <x-category label="{{ __('Schedule') }}" route="{{ route('trainer.jadwal') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </x-slot>
            </x-category>

        {{-- ================= MEMBER ================= --}}
        @elseif(Auth::user() && Auth::user()->hasRole('MEMBER'))
            <x-category label="{{ __('Supplements') }}" route="{{ route('member.suplemen') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Trainers') }}" route="{{ route('member.trainer') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234.074.115.148.227.22.336.207.346.399.68.573 1.002.11.208.216.417.31.627M18 18.72a9.094 9.094 0 01-3.741-.479 3 3 0 01-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Schedule') }}" route="{{ route('member.jadwal') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Update Membership') }}" route="{{ route('member.membership') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Transaction History') }}" route="{{ route('member.transaksi') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
            </x-category>

            {{-- ================= GUEST ================= --}}
            @else
                <x-category label="{{ __('Supplements') }}" route="{{ route('guest.suplemen') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Trainers') }}" route="{{ route('guest.trainer') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961m0 0c.323.41.645.821.964 1.234.074.115.148.227.22.336.207.346.399.68.573 1.002.11.208.216.417.31.627M18 18.72a9.094 9.094 0 01-3.741-.479 3 3 0 01-4.682-2.72m.982 2.982l.04.03c.35.3.683.622 1.008.961" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Schedule') }}" route="{{ route('guest.jadwal') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('Price List') }}" route="{{ route('guest.price') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                    </svg>
                </x-slot>
            </x-category>

            <x-category label="{{ __('About Us') }}" route="{{ route('guest.about') }}">
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-gray-300 group-hover:text-red-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </x-slot>
            </x-category>
            @endif

        </div>
    </section>

</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />