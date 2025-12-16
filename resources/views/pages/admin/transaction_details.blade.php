<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 justify-between">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Transaction Details') }}</h1>
                </div>
                <a href="{{ route('admin.transaksi') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
        </div>

        <!-- Transaction Info Card -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Order ID') }}</p>
                        <p class="text-white font-mono text-lg font-bold">{{ $transaction->order_id }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Order Date') }}</p>
                        <p class="text-white text-lg font-semibold">{{ $transaction->created_at->format('d F Y, H:i') }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Status') }}</p>
                        <div class="flex items-center gap-2">
                            @if($transaction->status === 'success')
                                <span class="px-3 py-1 bg-green-900/40 text-green-300 rounded-full text-sm font-bold border border-green-500/30 inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Completed') }}
                                </span>
                            @elseif($transaction->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-900/40 text-yellow-300 rounded-full text-sm font-bold border border-yellow-500/30 inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12h2z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Pending') }}
                                </span>
                            @elseif($transaction->status === 'canceled')
                                <span class="px-3 py-1 bg-red-900/40 text-red-300 rounded-full text-sm font-bold border border-red-500/30 inline-flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('Cancelled') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Payment Method') }}</p>
                        <p class="text-white text-lg font-semibold">{{ $transaction->metode_pembayaran ?? __('Unknown') }}</p>
                    </div>

                    <div class="pb-4 border-b border-gray-700">
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Customer') }}</p>
                        <p class="text-white text-lg font-semibold">{{ $transaction->user->nama ?? '-' }}</p>
                    </div>

                    <div>
                        <p class="text-gray-400 text-sm uppercase tracking-wider mb-1">{{ __('Email') }}</p>
                        <p class="text-white text-lg font-semibold break-all">{{ $transaction->user->email ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-8 mb-6">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                </svg>
                {{ __('Order Items') }}
            </h2>

            @php
                $products = $transaction->produkTransaksi ?? collect();
            @endphp

            @if($products->count() > 0)
                <div class="space-y-4">
                    @foreach($products as $prod)
                        <div class="flex items-center justify-between pb-4 border-b border-gray-700 last:border-0">
                            <div class="flex-grow">
                                @if($prod->id_membership)
                                    @if($prod->membershipPlan)
                                        <h3 class="text-white font-semibold text-lg">{{ $prod->membershipPlan->nama_paket_id ?? $prod->membershipPlan->nama_paket_en ?? __('Membership') }}</h3>
                                    @else
                                        <h3 class="text-white font-semibold text-lg">{{ __('Membership') }}</h3>
                                    @endif
                                    <p class="text-gray-400 text-sm">{{ __('Membership Plan') }}</p>
                                @elseif($prod->suplemen)
                                    <h3 class="text-white font-semibold text-lg">{{ $prod->suplemen->nama_suplemen }}</h3>
                                    <p class="text-gray-400 text-sm">{{ __('Supplement') }}</p>
                                @elseif($prod->kontrak)
                                    <h3 class="text-white font-semibold text-lg">{{ __('Trainer Contract') }}</h3>
                                    <p class="text-gray-400 text-sm">{{ $prod->kontrak->id_trainer ? \App\Models\Akun::find($prod->kontrak->id_trainer)->nama ?? 'Unknown Trainer' : 'Unknown Trainer' }}</p>
                                @else
                                    <h3 class="text-white font-semibold text-lg">{{ __('Item') }}</h3>
                                @endif
                            </div>

                            <div class="text-right">
                                @if($prod->harga_membership)
                                    <p class="text-red-400 font-bold text-lg">
                                        Rp {{ number_format($prod->harga_membership ?? 0, 0, ',', '.') }}
                                    </p>
                                @elseif($prod->suplemen)
                                    <p class="text-gray-400 text-sm">x{{ $prod->jumlah_produk ?? 1 }}</p>
                                    <p class="text-red-400 font-bold text-lg">
                                        Rp {{ number_format($prod->harga_produk ?? 0, 0, ',', '.') }}
                                    </p>
                                @elseif($prod->kontrak)
                                    <p class="text-red-400 font-bold text-lg">
                                        Rp {{ number_format($prod->harga_kontrak ?? 0, 0, ',', '.') }}
                                    </p>
                                @elseif($prod->harga_membership)
                                    <p class="text-red-400 font-bold text-lg">
                                        Rp {{ number_format($prod->harga_membership ?? 0, 0, ',', '.') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-8">{{ __('No items in this transaction') }}</p>
            @endif
        </div>

        <!-- Summary Card -->
        <div class="bg-gradient-to-b from-red-800 to-red-900 rounded-xl shadow-lg border border-red-700 p-8">
            <div class="space-y-4">
                <div class="flex justify-between items-center pb-4 border-b border-red-700">
                    <span class="text-gray-200">{{ __('Subtotal') }}</span>
                    <span class="text-white font-semibold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center pb-4 border-b border-red-700">
                    <span class="text-gray-200">{{ __('Tax') }}</span>
                    <span class="text-white font-semibold">Rp 0</span>
                </div>
                <div class="flex justify-between items-center pb-4 border-b border-red-700">
                    <span class="text-gray-200">{{ __('Shipping') }}</span>
                    <span class="text-white font-semibold">Rp 0</span>
                </div>
                <div class="flex justify-between items-center pt-2">
                    <span class="text-white text-xl font-bold">{{ __('Total') }}</span>
                    <span class="text-white text-3xl font-bold">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-8">
            <a href="{{ route('admin.transaksi') }}" class="flex-1 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 text-center">
                {{ __('Back to Transactions') }}
            </a>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
