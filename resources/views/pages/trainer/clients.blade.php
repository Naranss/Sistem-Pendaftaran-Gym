<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Class Schedule') }}</h1>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6 text-white">
                <h2 class="text-2xl font-semibold mb-4">Daftar Klien Aktif</h2>

                @if(isset($contracts) && $contracts->isNotEmpty())
                    <table class="min-w-full bg-gray-900 text-white">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">#</th>
                                <th class="px-4 py-2 text-left">Nama Klien</th>
                                <th class="px-4 py-2 text-left">Berakhir Kontrak</th>
                                <th class="px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contracts as $i => $contract)
                                @php
                                    $client = \App\Models\Akun::find($contract->id_client);
                                @endphp
                                <tr class="border-t border-gray-700">
                                    <td class="px-4 py-2">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2">{{ $client->nama ?? '—' }}</td>
                                    <td class="px-4 py-2">{{ optional($contract->tanggal_berakhir)->format('Y-m-d') ?? '—' }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="{{ url('/trainer/clients/' . $contract->id . '/edit') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-gray-400">Belum ada klien aktif.</p>
                @endif
            </div>
        </div>

        <div class="mt-12 text-center">
            <p class="text-lg text-gray-400 mb-6">{{ __('Want to join our exciting classes?') }}</p>
            <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                {{ __('Register Now') }}
            </a>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />