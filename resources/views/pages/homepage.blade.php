<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black">

    {{-- ================= Hero Carousel Section ================= --}}
    <section class="relative overflow-hidden h-96 md:h-[500px]" x-data="carousel()">
        <!-- Carousel Images -->
        <div class="relative w-full h-full">
            <!-- Slide 1 -->
            <div class="absolute inset-0 transition-opacity duration-1000 bg-cover bg-center" 
                 x-bind:class="currentSlide === 0 ? 'opacity-100' : 'opacity-0'"
                 style="background-image: url('{{ asset('assets/promotion/promotion1.png') }}');">
            </div>

            <!-- Slide 2 -->
            <div class="absolute inset-0 transition-opacity duration-1000 bg-cover bg-center" 
                 x-bind:class="currentSlide === 1 ? 'opacity-100' : 'opacity-0'"
                 style="background-image: url('{{ asset('assets/promotion/promotion2.png') }}');">
            </div>

            <!-- Slide 3 -->
            <div class="absolute inset-0 transition-opacity duration-1000 bg-cover bg-center" 
                 x-bind:class="currentSlide === 2 ? 'opacity-100' : 'opacity-0'"
                 style="background-image: url('{{ asset('assets/promotion/promotion3.png') }}');">
            </div>

            <!-- Slide 4 -->
            <div class="absolute inset-0 transition-opacity duration-1000 bg-cover bg-center" 
                 x-bind:class="currentSlide === 3 ? 'opacity-100' : 'opacity-0'"
                 style="background-image: url('{{ asset('assets/promotion/promotion4.png') }}');">
            </div>

            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>

        <!-- Previous Button -->
        <button @click="prevSlide()" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Next Button -->
        <button @click="nextSlide()" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 text-white p-3 rounded-full transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Dot Indicators -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2">
            <template x-for="(slide, index) in totalSlides" :key="index">
                <button @click="goToSlide(index)" 
                        class="w-3 h-3 rounded-full transition duration-300"
                        x-bind:class="currentSlide === index ? 'bg-white' : 'bg-white/50'">
                </button>
            </template>
        </div>
    </section>

    {{-- ================= CTA Button ================= --}}
    @guest
    <section class="bg-gray-900 border-b border-gray-700 py-6">
        <div class="container mx-auto px-6 text-center">
            <a href="{{ route('register') }}" 
               class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                {{ __('Start Your Journey') }}
            </a>
        </div>
    </section>
    @endguest

    <script>
        function carousel() {
            return {
                currentSlide: 0,
                totalSlides: 4,
                autoSlideInterval: null,

                init() {
                    this.startAutoSlide();
                },

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                    this.resetAutoSlide();
                },

                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                    this.resetAutoSlide();
                },

                goToSlide(index) {
                    this.currentSlide = index;
                    this.resetAutoSlide();
                },

                startAutoSlide() {
                    this.autoSlideInterval = setInterval(() => {
                        this.nextSlide();
                    }, 5000);
                },

                resetAutoSlide() {
                    clearInterval(this.autoSlideInterval);
                    this.startAutoSlide();
                }
            }
        }
    </script>

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
            <!-- <x-category label="{{ __('Chat') }}" route="{{ route('chat.room.index') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Chat.svg') }}" 
                    alt="Chat Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category> -->

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
            <!-- <x-category label="{{ __('Chat') }}" route="{{ route('chat.room.index') }}">
                <x-slot name="icon">
                    <img 
                    src="{{ asset('assets/icons/Chat.svg') }}" 
                    alt="Chat Icon" 
                    class="w-16 h-16 group-hover:scale-110 transition-transform duration-300" />
                </x-slot>
            </x-category> -->

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