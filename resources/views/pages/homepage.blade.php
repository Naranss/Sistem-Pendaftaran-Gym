<x-navbar />
 <main class="flex-grow px-10 py-8 text-center">
        <div class="bg-gray-300 text-black font-extrabold text-4xl py-8 rounded-xl mb-10 tracking-widest">
            GYM BY YAPPING CLUB
        </div>

        <h2 class="text-lg font-semibold mb-4">Kategori</h2>

        <div class="flex flex-wrap justify-center gap-10">

            {{-- === Guest === --}}
            @guest
                <x-category icon="💊" label="Suplemen" />
                <x-category icon="🏋️‍♂️" label="Trainer" />
                <x-category icon="📅" label="Jadwal" />
                <x-category icon="👥" label="Membership" />
                <x-category icon="🧾" label="Riwayat Transaksi" />
            @endguest

            {{-- === Admin (Sesuai Gambar Admin Homepage.jpg) === --}}
            @role('admin')
                <x-category icon="💊" label="Kelola Suplemen" />
                <x-category icon="🏋️" label="Kelola Alat Gym" />
                <x-category icon="👤" label="Kelola Akun" />
                <x-category icon="💰" label="Kelola Transaksi" />
            @endrole

            {{-- === Trainer (Sesuai Gambar Trainer Homepage.jpg) === --}}
            @role('trainer')
                <x-category icon="📅" label="Jadwal" />
            @endrole

            {{-- === Member (Sesuai Gambar Member Homepage.jpg) === --}}
            @role('member')
                <x-category icon="💊" label="Suplemen" />
                <x-category icon="🏋️‍♂️" label="Trainer" />
                <x-category icon="📅" label="Jadwal" />
                <x-category icon="👥" label="Perbarui Membership" />
                <x-category icon="🧾" label="Riwayat Transaksi" />
            @endrole

        </div>

        @auth
            <div class="flex justify-end mt-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-full text-white font-bold">
                        LOG OUT
                    </button>
                </form>
            </div>
        @endauth
    </main>