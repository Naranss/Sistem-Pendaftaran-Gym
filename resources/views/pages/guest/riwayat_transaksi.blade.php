<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Transaction History') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Track all your purchases and subscription payments') }}</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($transaksi->count() > 0)
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <div class="bg-gradient-to-br from-blue-900/40 to-blue-900/20 border border-blue-500/30 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-300 text-sm">{{ __('Total Transactions') }}</p>
                            <p class="text-white text-2xl font-bold">{{ $transaksi->total() }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-green-900/40 to-green-900/20 border border-green-500/30 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-300 text-sm">{{ __('Completed') }}</p>
                            <p class="text-white text-2xl font-bold">{{ $transaksi->where('status', 'completed')->count() }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-yellow-900/40 to-yellow-900/20 border border-yellow-500/30 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-yellow-300 text-sm">{{ __('Pending') }}</p>
                            <p class="text-white text-2xl font-bold">{{ $transaksi->where('status', 'pending')->count() }}</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block">
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Date') }}
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Type') }}
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Description') }}
                                    </th>
                                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Amount') }}
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Method') }}
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($transaksi as $item)
                                    <tr class="hover:bg-gray-700/50 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm">
                                                <p class="text-white font-medium">{{ $item->created_at->format('d M Y') }}</p>
                                                <p class="text-gray-400 text-xs">{{ $item->created_at->format('H:i') }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($item->id_produk)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                                    <span class="px-3 py-1 bg-blue-900/40 text-blue-300 rounded-full text-sm font-semibold border border-blue-500/30">
                                                        {{ __('Product') }}
                                                    </span>
                                                </div>
                                            @elseif($item->id_kontrak)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                                    <span class="px-3 py-1 bg-purple-900/40 text-purple-300 rounded-full text-sm font-semibold border border-purple-500/30">
                                                        {{ __('Trainer') }}
                                                    </span>
                                                </div>
                                            @elseif($item->membership)
                                                <div class="flex items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                                    <span class="px-3 py-1 bg-green-900/40 text-green-300 rounded-full text-sm font-semibold border border-green-500/30">
                                                        {{ __('Membership') }}
                                                    </span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-white text-sm font-medium">
                                                @if($item->id_produk)
                                                    @if($item->jumlah_produk)
                                                        {{ $item->jumlah_produk }} x {{ __('Product') }}
                                                    @else
                                                        {{ __('Product Purchase') }}
                                                    @endif
                                                @elseif($item->id_kontrak && $item->kontrak && $item->kontrak->trainer)
                                                    {{ __('Trainer') }}: <span class="text-red-400">{{ $item->kontrak->trainer->nama }}</span>
                                                @elseif($item->membership)
                                                    {{ __('Membership') }}: <span class="text-green-400">{{ $item->membership }}</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <p class="text-xl font-bold text-white">
                                                Rp {{ number_format($item->harga_produk ?? $item->harga_kontrak ?? $item->harga_membership ?? 0, 0, ',', '.') }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $item->metode_pembayaran ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($item->status === 'completed')
                                                <span class="px-3 py-1 bg-green-900/40 text-green-300 rounded-full text-sm font-bold border border-green-500/30 inline-flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                    {{ __('Completed') }}
                                                </span>
                                            @elseif($item->status === 'pending')
                                                <span class="px-3 py-1 bg-yellow-900/40 text-yellow-300 rounded-full text-sm font-bold border border-yellow-500/30 inline-flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12h2z" clip-rule="evenodd" /></svg>
                                                    {{ __('Pending') }}
                                                </span>
                                            @elseif($item->status === 'cancelled')
                                                <span class="px-3 py-1 bg-red-900/40 text-red-300 rounded-full text-sm font-bold border border-red-500/30 inline-flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                                    {{ __('Cancelled') }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden space-y-4">
                @foreach($transaksi as $item)
                    <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-4 shadow-lg border border-gray-700 hover:border-red-500/50 transition duration-200">
                        <!-- Header -->
                        <div class="flex justify-between items-start mb-4 pb-4 border-b border-gray-700">
                            <div>
                                <p class="text-gray-400 text-xs font-semibold uppercase">{{ $item->created_at->format('d M Y') }}</p>
                                <p class="text-gray-500 text-xs">{{ $item->created_at->format('H:i') }}</p>
                            </div>
                            @if($item->status === 'completed')
                                <span class="px-2 py-1 bg-green-900/40 text-green-300 rounded text-xs font-bold border border-green-500/30 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    {{ __('Completed') }}
                                </span>
                            @elseif($item->status === 'pending')
                                <span class="px-2 py-1 bg-yellow-900/40 text-yellow-300 rounded text-xs font-bold border border-yellow-500/30 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12h2z" clip-rule="evenodd" /></svg>
                                    {{ __('Pending') }}
                                </span>
                            @elseif($item->status === 'cancelled')
                                <span class="px-2 py-1 bg-red-900/40 text-red-300 rounded text-xs font-bold border border-red-500/30 inline-flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                    {{ __('Cancelled') }}
                                </span>
                            @endif
                        </div>

                        <!-- Type Badge -->
                        <div class="mb-3">
                            @if($item->id_produk)
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                    <span class="px-2 py-1 bg-blue-900/40 text-blue-300 rounded text-xs font-bold border border-blue-500/30">
                                        {{ __('Product') }}
                                    </span>
                                </div>
                            @elseif($item->id_kontrak)
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-purple-500"></div>
                                    <span class="px-2 py-1 bg-purple-900/40 text-purple-300 rounded text-xs font-bold border border-purple-500/30">
                                        {{ __('Trainer') }}
                                    </span>
                                </div>
                            @elseif($item->membership)
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                    <span class="px-2 py-1 bg-green-900/40 text-green-300 rounded text-xs font-bold border border-green-500/30">
                                        {{ __('Membership') }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="text-white font-semibold mb-3">
                            @if($item->id_produk)
                                @if($item->jumlah_produk)
                                    {{ $item->jumlah_produk }} x {{ __('Product') }}
                                @else
                                    {{ __('Product Purchase') }}
                                @endif
                            @elseif($item->id_kontrak && $item->kontrak && $item->kontrak->trainer)
                                {{ __('Trainer') }}: <span class="text-red-400">{{ $item->kontrak->trainer->nama }}</span>
                            @elseif($item->membership)
                                {{ __('Membership') }}: <span class="text-green-400">{{ $item->membership }}</span>
                            @endif
                        </p>

                        <!-- Footer -->
                        <div class="flex justify-between items-end pt-3 border-t border-gray-700">
                            <p class="text-gray-400 text-xs">
                                {{ $item->metode_pembayaran ?? __('No method') }}
                            </p>
                            <p class="text-lg font-bold text-white">
                                Rp {{ number_format($item->harga_produk ?? $item->harga_kontrak ?? $item->harga_membership ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($transaksi->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Transactions Yet') }}</h3>
                <p class="text-gray-400 mb-6">{{ __('You haven\'t made any purchases yet. Start shopping now and your transactions will appear here!') }}</p>
                <a href="{{ route('suplemen') }}" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                    {{ __('Browse Products') }}
                </a>
            </div>
        @endif
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
