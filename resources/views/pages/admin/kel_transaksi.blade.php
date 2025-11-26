<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-8">
    <div class="container mx-auto px-6">
        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Kelola Transaksi</h1>
        </div>

        {{-- Search Bar --}}
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.transaksi') }}" class="flex gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari transaksi (nama akun, email)..." 
                        class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                    >
                </div>
                <button 
                    type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300 flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                @if(request('search'))
                    <a 
                        href="{{ route('admin.transaksi') }}" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300"
                    >
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                KODE TRANSAKSI
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NAMA AKUN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NAMA ITEM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                JUMLAH
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                HARGA SATUAN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                TOTAL HARGA
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                TGL TRANSAKSI
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                METODE PEMBAYARAN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                STATUS
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse ($transaksi as $item)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                    TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->user->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-300">
                                    @if($item->membership)
                                        Membership {{ ucfirst($item->membership) }}
                                    @elseif($item->keranjang && $item->keranjang->suplemen)
                                        {{ $item->keranjang->suplemen->nama_suplemen }}
                                    @elseif($item->kontrak)
                                        Kontrak Trainer
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->jumlah_produk ?? 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $hargaSatuan = 0;
                                        if ($item->harga_membership) {
                                            $hargaSatuan = $item->harga_membership;
                                        } elseif ($item->harga_produk) {
                                            $hargaSatuan = $item->harga_produk;
                                        } elseif ($item->harga_kontrak) {
                                            $hargaSatuan = $item->harga_kontrak;
                                        }
                                    @endphp
                                    Rp {{ number_format($hargaSatuan, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">
                                    @php
                                        $totalHarga = 0;
                                        if ($item->harga_membership) {
                                            $totalHarga = $item->harga_membership * ($item->jumlah_produk ?? 1);
                                        } elseif ($item->harga_produk) {
                                            $totalHarga = $item->harga_produk * ($item->jumlah_produk ?? 1);
                                        } elseif ($item->harga_kontrak) {
                                            $totalHarga = $item->harga_kontrak;
                                        }
                                    @endphp
                                    Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <span class="px-2 py-1 rounded bg-blue-900 text-blue-300">
                                        {{ ucfirst($item->metode_pembayaran ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $status = $item->status ?? ($item->metode_pembayaran === 'pending' ? 'Pending' : 'Lunas');
                                        $statusClass = match(strtolower($status)) {
                                            'lunas', 'selesai', 'paid' => 'bg-green-900 text-green-300',
                                            'pending', 'menunggu' => 'bg-yellow-900 text-yellow-300',
                                            'gagal', 'failed', 'canceled' => 'bg-red-900 text-red-300',
                                            default => 'bg-gray-900 text-gray-300'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded {{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p>Tidak ada data transaksi ditemukan</p>
                                        @if(request('search'))
                                            <p class="text-sm mt-1">Coba cari dengan kata kunci lain</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($transaksi->hasPages())
                <div class="bg-gray-700 px-6 py-4 border-t border-gray-600">
                    <div class="text-white">
                        {{ $transaksi->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

