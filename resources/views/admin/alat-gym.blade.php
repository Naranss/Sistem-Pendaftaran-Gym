<x-layout title="Kelola Alat Gym - Admin">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-white">Kelola Alat Gym</h1>
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                Tambah Alat
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($alatGym as $alat)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $alat->gambar) }}" alt="{{ $alat->nama }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $alat->nama }}</h3>
                    <p class="text-gray-600 mb-4">{{ $alat->deskripsi }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Status: {{ $alat->status }}</span>
                        <div class="space-x-2">
                            <button class="text-blue-500 hover:text-blue-700">Edit</button>
                            <button class="text-red-500 hover:text-red-700">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>