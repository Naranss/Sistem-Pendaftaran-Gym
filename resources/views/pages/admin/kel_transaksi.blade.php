<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Manage Transactions') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('View all system transactions and payment records') }}</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/30 border border-green-500/50 rounded-lg text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 rounded-lg text-red-300">
                {{ session('error') }}
            </div>
        @endif

        {{-- Search Bar --}}
        <div class="mb-8">
            <form method="GET" action="{{ route('admin.transaksi') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="{{ __('Search transactions...') }}" 
                        class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600 transition"
                    >
                </div>
                <button 
                    type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2 whitespace-nowrap"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Search') }}
                </button>
                @if(request('search'))
                    <a 
                        href="{{ route('admin.transaksi') }}" 
                        class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition duration-300 text-center"
                    >
                        {{ __('Reset') }}
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Transaction Code') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Account Name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Item Name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Quantity') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Unit Price') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Total Price') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Date') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Payment Method') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Status') }}
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
                                    <span class="px-3 py-1 rounded text-xs font-semibold bg-blue-900/30 text-blue-300 border border-blue-500/50">
                                        {{ ucfirst($item->metode_pembayaran ?? 'pending') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $status = $item->status ?? ($item->metode_pembayaran === 'pending' ? 'Pending' : 'Paid');
                                        $statusClass = match(strtolower($status)) {
                                            'lunas', 'selesai', 'paid' => 'bg-green-900/30 text-green-300 border border-green-500/50',
                                            'pending', 'menunggu' => 'bg-yellow-900/30 text-yellow-300 border border-yellow-500/50',
                                            'gagal', 'failed', 'canceled' => 'bg-red-900/30 text-red-300 border border-red-500/50',
                                            default => 'bg-gray-900/30 text-gray-300 border border-gray-500/50'
                                        };
                                    @endphp
                                    <span class="px-3 py-1 rounded text-xs font-semibold {{ $statusClass }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-8 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                        <p>{{ __('No transaction data found') }}</p>
                                        @if(request('search'))
                                            <p class="text-sm mt-1">{{ __('Try searching with different keywords') }}</p>
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

