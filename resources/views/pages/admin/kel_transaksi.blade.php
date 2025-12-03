<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
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
        <div class="bg-green-500/20 border border-green-500 text-green-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
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
                        <p class="text-white text-2xl font-bold">{{ $transaksi->where('status', 'success')->count() }}</p>
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
                                    {{ __('Order ID') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    {{ __('Account Name') }}
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
                                        <p class="text-white font-medium">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : $item->created_at->format('d M Y') }}</p>
                                        <p class="text-gray-400 text-xs">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i') : $item->created_at->format('H:i') }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                        <span class="px-3 py-1 bg-blue-900/40 text-blue-300 rounded-full text-sm font-semibold border border-blue-500/30">
                                            {{ $item->order_id ?? 'TRX-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->user->nama ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-white text-sm font-medium">
                                        @php
                                            $products = $item->produkTransaksi ?? collect();
                                        @endphp
                                        @if($products->count() > 0)
                                            <div class="space-y-1">
                                                @foreach($products->take(2) as $prod)
                                                    <div>
                                                        @if($prod->membership_id)
                                                            @php
                                                                $membership = \App\Models\MembershipPlan::find($prod->membership_id);
                                                            @endphp
                                                            @if($membership)
                                                                <span class="font-semibold">{{ $membership->nama_paket_id ?? $membership->nama_paket_en }}</span>
                                                            @else
                                                                <span class="font-semibold">{{ __('Membership') }}</span>
                                                            @endif
                                                        @elseif($prod->suplemen)
                                                            <span class="font-semibold">{{ $prod->suplemen->nama_suplemen }}</span>
                                                            <span class="text-gray-400">x{{ $prod->jumlah_produk ?? 1 }}</span>
                                                        @elseif($prod->kontrak)
                                                            <span class="font-semibold">{{ __('Trainer Contract') }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                                @if($products->count() > 2)
                                                    <div class="text-gray-400 text-xs">
                                                        +{{ $products->count() - 2 }} {{ __('more') }}
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-400">{{ __('No details') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <p class="text-xl font-bold text-white">
                                        Rp {{ number_format($item->total ?? 0, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <span class="px-3 py-1 bg-blue-900/40 text-blue-300 rounded-full text-xs font-bold border border-blue-500/30">
                                        {{ $item->metode_pembayaran ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($item->status === 'success')
                                    <span class="px-3 py-1 bg-green-900/40 text-green-300 rounded-full text-sm font-bold border border-green-500/30 inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Success') }}
                                    </span>
                                    @elseif($item->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-900/40 text-yellow-300 rounded-full text-sm font-bold border border-yellow-500/30 inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12h2z" clip-rule="evenodd" />
                                        </svg>
                                        {{ __('Pending') }}
                                    </span>
                                    @elseif($item->status === 'canceled')
                                    <span class="px-3 py-1 bg-red-900/40 text-red-300 rounded-full text-sm font-bold border border-red-500/30 inline-flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
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
                        <p class="text-gray-400 text-xs font-semibold uppercase">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d M Y') : $item->created_at->format('d M Y') }}</p>
                        <p class="text-gray-500 text-xs">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('H:i') : $item->created_at->format('H:i') }}</p>
                    </div>
                    @if($item->status === 'success')
                    <span class="px-2 py-1 bg-green-900/40 text-green-300 rounded text-xs font-bold border border-green-500/30 inline-flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Success') }}
                    </span>
                    @elseif($item->status === 'pending')
                    <span class="px-2 py-1 bg-yellow-900/40 text-yellow-300 rounded text-xs font-bold border border-yellow-500/30 inline-flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16v-2a6 6 0 100-12 6 6 0 000 12h2z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Pending') }}
                    </span>
                    @elseif($item->status === 'canceled')
                    <span class="px-2 py-1 bg-red-900/40 text-red-300 rounded text-xs font-bold border border-red-500/30 inline-flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Cancelled') }}
                    </span>
                    @endif
                </div>

                <!-- Account Info -->
                <div class="mb-3">
                    <p class="text-gray-400 text-xs uppercase font-semibold">{{ __('Account') }}</p>
                    <p class="text-white font-medium">{{ $item->user->nama ?? '-' }}</p>
                </div>

                <!-- Order ID -->
                <div class="mb-3">
                    <p class="text-gray-400 text-xs uppercase font-semibold">{{ __('Order ID') }}</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        <span class="px-2 py-1 bg-blue-900/40 text-blue-300 rounded text-xs font-bold border border-blue-500/30">
                            {{ $item->order_id ?? 'TRX-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <p class="text-gray-400 text-xs uppercase font-semibold">{{ __('Description') }}</p>
                    @php
                        $products = $item->produkTransaksi ?? collect();
                    @endphp
                    @if($products->count() > 0)
                        <div class="space-y-1 text-white text-sm">
                            @foreach($products->take(2) as $prod)
                                <div>
                                    @if($prod->membership_id)
                                        @php
                                            $membership = \App\Models\MembershipPlan::find($prod->membership_id);
                                        @endphp
                                        @if($membership)
                                            <span class="font-semibold">{{ $membership->nama_paket_id ?? $membership->nama_paket_en }}</span>
                                        @else
                                            <span class="font-semibold">{{ __('Membership') }}</span>
                                        @endif
                                    @elseif($prod->suplemen)
                                        <span class="font-semibold">{{ $prod->suplemen->nama_suplemen }}</span>
                                        <span class="text-gray-400">x{{ $prod->jumlah_produk ?? 1 }}</span>
                                    @elseif($prod->kontrak)
                                        <span class="font-semibold">{{ __('Trainer Contract') }}</span>
                                    @endif
                                </div>
                            @endforeach
                            @if($products->count() > 2)
                                <div class="text-gray-400 text-xs">
                                    +{{ $products->count() - 2 }} {{ __('more') }}
                                </div>
                            @endif
                        </div>
                    @else
                        <span class="text-gray-400">{{ __('No details') }}</span>
                    @endif
                </div>

                <!-- Amount and Method -->
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <div>
                        <p class="text-gray-400 text-xs uppercase font-semibold">{{ __('Amount') }}</p>
                        <p class="text-lg font-bold text-white">Rp {{ number_format($item->total ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase font-semibold">{{ __('Method') }}</p>
                        <span class="px-2 py-1 bg-blue-900/40 text-blue-300 rounded text-xs font-bold border border-blue-500/30 inline-block">
                            {{ $item->metode_pembayaran ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @endif

        {{-- Pagination --}}
        @if($transaksi->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="text-white">
                    {{ $transaksi->appends(request()->query())->links() }}
                </div>
            </div>
        @endif

        @if($transaksi->count() === 0)
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700 p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
            <p class="text-gray-400 text-lg">{{ __('No transaction data found') }}</p>
            @if(request('search'))
                <p class="text-gray-500 text-sm mt-2">{{ __('Try searching with different keywords') }}</p>
            @endif
        </div>
        @endif
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
