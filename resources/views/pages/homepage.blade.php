<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black">

    {{-- ================= Hero Section ================= --}}
    <section class="relative overflow-hidden bg-cover bg-center h-96" 
        style="background-image: url('{{ asset("assets/background/background.jpg") }}');">
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
                    <img 
                    src="{{ asset('assets/icons/Suplemen.svg') }}" 
                    alt="Supplements Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Equipment') }}" route="{{ route('admin.alat-gym') }}">
                <x-slot name="icon">
                   <img 
                   src="{{ asset('assets/icons/Equipment.svg') }}" 
                   alt="Equipment Icon" 
                   class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Accounts') }}" route="{{ route('admin.akun') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Manage Account.svg') }}" 
                    alt="Account Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Manage Transactions') }}" route="{{ route('admin.transaksi') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Transaction.svg') }}" 
                    alt="Transaction Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

        {{-- ================= TRAINER ================= --}}
        @elseif(Auth::user() && Auth::user()->hasRole('TRAINER'))
            <x-category label="{{ __('Schedule') }}" route="{{ route('trainer.jadwal') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Schedule.svg') }}" 
                    alt="Schedule Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

        {{-- ================= MEMBER ================= --}}
        @elseif(Auth::user() && Auth::user()->hasRole('MEMBER'))
            <x-category label="{{ __('Supplements') }}" route="{{ route('suplemen') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Suplemen.svg') }}" 
                    alt="Supplements Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Trainers') }}" route="{{ route('member.trainer') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Trainer.svg') }}" 
                    alt="Trainer Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Schedule') }}" route="{{ route('member.jadwal') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Schedule.svg') }}" 
                    alt="Schedule Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Update Membership') }}" route="{{ route('member.membership') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Membership.svg') }}" 
                    alt="Membership Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Transaction History') }}" route="{{ route('member.riwayat') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Transaction.svg') }}" 
                    alt="Transaction Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            {{-- ================= GUEST ================= --}}
            @else
                <x-category label="{{ __('Supplements') }}" route="{{ route('suplemen') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Suplemen.svg') }}" 
                    alt="Supplements Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Trainers') }}" route="{{ route('guest.trainer') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Trainer.svg') }}" 
                    alt="Trainer Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Schedule') }}" route="{{ route('guest.jadwal') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Schedule.svg') }}" 
                    alt="Schedule Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Membership') }}" route="{{ route('guest.membership') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Membership.svg') }}" 
                    alt="Membership Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>

            <x-category label="{{ __('Transaction History') }}" route="{{ route('guest.riwayat') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Transaction.svg') }}" 
                    alt="Transaction Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category>
            @endif

        </div>
    </section>

</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />