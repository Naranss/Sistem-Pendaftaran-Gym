<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">Edit Klien</h1>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden p-6 text-white">
            <p><strong>Nama Klien:</strong> {{ $client->nama ?? '—' }}</p>
            <p class="mt-2"><strong>Tanggal Berakhir Kontrak:</strong> {{ optional($kontrak->tanggal_berakhir)->format('Y-m-d') ?? '—' }}</p>

            <div class="mt-6">
                <!-- Placeholder: you can replace this with a proper edit form for the contract or redirect to the jadwal editor -->
                <a href="{{ route('trainer.jadwal') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Edit Jadwal Klien
                </a>
                <a href="{{ url()->previous() }}" class="ml-3 inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
