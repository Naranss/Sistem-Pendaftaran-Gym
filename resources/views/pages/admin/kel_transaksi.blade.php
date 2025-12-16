<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Manage Transactions') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
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
                <div class="flex gap-2">
                    <button 
                        type="submit" 
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2 whitespace-nowrap"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Search') }}
                    </button>
                    <button 
                        type="button"
                        onclick="openAddModal()" 
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2 whitespace-nowrap"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Add Transaction') }}
                    </button>
                    @if(request('search'))
                        <a 
                            href="{{ route('admin.transaksi') }}" 
                            class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition duration-300 text-center"
                        >
                            {{ __('Reset') }}
                        </a>
                    @endif
                </div>
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
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-300 uppercase tracking-wider">
                                    {{ __('Action') }}
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
                                                        @if($prod->id_membership)
                                                            @if($prod->membershipPlan)
                                                                <span class="font-semibold">{{ $prod->membershipPlan->nama_paket_id ?? $prod->membershipPlan->nama_paket_en }}</span>
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
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('admin.transaksi.show', $item->id) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ __('View') }}
                                    </a>
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
                                        @if($prod->membershipPlan)
                                            <span class="font-semibold">{{ $prod->membershipPlan->nama_paket_id ?? $prod->membershipPlan->nama_paket_en }}</span>
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

                <!-- Action -->
                <a href="{{ route('admin.transaksi.show', $item->id) }}" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-bold transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ __('View Details') }}
                </a>
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

{{-- Add Transaction Modal --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-lg mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">{{ __('Add Transaction') }}</h2>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="addForm" method="POST" action="{{ route('admin.transaksi.store') }}" onsubmit="return validateAddForm(event)">
            @csrf
            <div class="space-y-4">
                <!-- Error Display -->
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500 text-red-200 px-4 py-3 rounded-lg mb-4">
                        <p class="font-bold mb-2">{{ __('Validation Errors:') }}</p>
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Account Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Account') }} <span class="text-red-500">*</span></label>
                    <select name="id_akun" id="id_akun" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" required>
                        <option value="">{{ __('Select Account') }}</option>
                        @foreach($users ?? [] as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Transaction Type Selection -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Transaction Type') }} <span class="text-red-500">*</span></label>
                    <select name="transaction_type" id="transaction_type" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" onchange="updateProductOptions()" required>
                        <option value="">{{ __('Select Transaction Type') }}</option>
                        <option value="supplement">{{ __('Supplement') }}</option>
                        <option value="membership">{{ __('Membership') }}</option>
                        <option value="contract">{{ __('Trainer Contract') }}</option>
                    </select>
                </div>

                <!-- Supplement Options -->
                <div id="supplement-section" class="hidden">
                    <div class="space-y-3" id="supplements-container">
                        <div class="supplement-item bg-gray-700 rounded-lg p-3">
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-medium text-gray-300">{{ __('Select Supplement') }} <span class="text-red-500">*</span></label>
                                <button type="button" class="add-supplement-btn text-green-400 hover:text-green-300 transition" onclick="addSupplementField(event)" title="Add another supplement">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                            <select name="supplement_id[]" class="supplement-select w-full px-4 py-2 rounded-lg bg-gray-600 text-white border border-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600 mb-2" onchange="updateSupplementsPrice()">
                                <option value="">{{ __('Choose Supplement') }}</option>
                            </select>
                            <div class="flex gap-2">
                                <div class="flex-1">
                                    <label class="block text-xs font-medium text-gray-400 mb-1">{{ __('Quantity') }} <span class="text-red-500">*</span></label>
                                    <input type="number" name="supplement_quantity[]" class="supplement-quantity w-full px-3 py-2 rounded-lg bg-gray-600 text-white border border-gray-500 focus:outline-none focus:ring-2 focus:ring-red-600" min="1" value="1" onchange="updateSupplementsPrice()">
                                </div>
                                <div class="remove-supplement-container hidden">
                                    <button type="button" class="remove-supplement-btn text-red-400 hover:text-red-300 transition mt-6" onclick="removeSupplementField(event)" title="Remove this supplement">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1"><span class="supplement-stock">0</span> {{ __('in stock') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Membership Options -->
                <div id="membership-section" class="hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Select Membership Plan') }} <span class="text-red-500">*</span></label>
                        <select name="membership_id" id="membership_id" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" onchange="updateMembershipPrice()">
                            <option value="">{{ __('Choose Membership') }}</option>
                        </select>
                    </div>
                    <p class="text-xs text-gray-400 mt-2"><span id="membership-duration">-</span> {{ __('duration') }}</p>
                </div>

                <!-- Contract Options -->
                <div id="contract-section" class="hidden">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Select Trainer') }} <span class="text-red-500">*</span></label>
                        <select name="trainer_id" id="trainer_id" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" onchange="updateContractPrice()">
                            <option value="">{{ __('Choose Trainer') }}</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Contract Price') }} <span class="text-red-500">*</span></label>
                        <input type="number" name="contract_price" id="contract_price" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" min="0" value="0" onchange="updateContractPrice()">
                    </div>
                </div>

                <!-- Total Price Display -->
                <div class="bg-gray-700 rounded-lg p-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300 font-medium">{{ __('Calculated Total') }}:</span>
                        <span class="text-2xl font-bold text-green-400">Rp <span id="calculated_total">0</span></span>
                    </div>
                </div>

                <!-- Hidden Total Price Input -->
                <input type="hidden" name="total" id="total" value="0">

                <!-- Hidden Order ID Input (Auto-generated) -->
                <input type="hidden" name="order_id" id="order_id" value="">

                <!-- Payment Method -->
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Payment Method') }} <span class="text-red-500">*</span></label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600" required>
                        <option value="">{{ __('Select Payment Method') }}</option>
                        <option value="CASH">{{ __('Cash') }}</option>
                        <option value="TRANSFER">{{ __('Transfer') }}</option>
                        <option value="DEBIT">{{ __('Debit Card') }}</option>
                        <option value="CREDIT">{{ __('Credit Card') }}</option>
                        <option value="E-WALLET">{{ __('E-Wallet') }}</option>
                    </select>
                </div>


                <!-- Hidden status Input (always success) -->
                <input type="hidden" name="status" id="status" value="success">

            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">{{ __('Cancel') }}</button>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

<!-- Data Storage -->
<script>
    // Product data
    const productsData = {
        supplements: {!! json_encode($supplements ?? []) !!},
        memberships: {!! json_encode($memberships ?? []) !!},
        trainers: {!! json_encode($trainers ?? []) !!}
    };

    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addModal').classList.add('flex');
        loadProductOptions();
        generateOrderId();
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.getElementById('addModal').classList.remove('flex');
        // Reset supplements container
        const container = document.getElementById('supplements-container');
        if (container) {
            const firstItem = container.querySelector('.supplement-item');
            const items = container.querySelectorAll('.supplement-item');
            items.forEach((item, index) => {
                if (index > 0) item.remove();
            });
            if (firstItem) {
                firstItem.querySelector('.supplement-select').value = '';
                firstItem.querySelector('.supplement-quantity').value = '1';
            }
        }
        document.getElementById('addForm').reset();
        document.getElementById('transaction_type').value = '';
        hideAllProductSections();
    }

    function generateOrderId() {
        const timestamp = Date.now();
        const random = Math.floor(Math.random() * 1000);
        const orderId = `TRX-${timestamp}-${random}`;
        document.getElementById('order_id').value = orderId;
    }

    function hideAllProductSections() {
        document.getElementById('supplement-section').classList.add('hidden');
        document.getElementById('membership-section').classList.add('hidden');
        document.getElementById('contract-section').classList.add('hidden');
        // Reset product-specific fields
        document.getElementById('membership_id').value = '';
        document.getElementById('trainer_id').value = '';
        document.getElementById('contract_price').value = '0';
    }

    function loadProductOptions() {
        // Load supplements for all fields
        const supplementSelects = document.querySelectorAll('.supplement-select');
        supplementSelects.forEach(select => {
            let currentValue = select.value;
            select.innerHTML = '<option value="">{{ __("Choose Supplement") }}</option>';
            if (productsData.supplements && Array.isArray(productsData.supplements)) {
                productsData.supplements.forEach(supplement => {
                    select.innerHTML += `<option value="${supplement.id}" data-price="${supplement.harga}" data-stock="${supplement.stok}">${supplement.nama_suplemen}</option>`;
                });
            }
            if (currentValue) select.value = currentValue;
        });

        // Load memberships
        const membershipSelect = document.getElementById('membership_id');
        membershipSelect.innerHTML = '<option value="">{{ __("Choose Membership") }}</option>';
        if (productsData.memberships && Array.isArray(productsData.memberships)) {
            productsData.memberships.forEach(membership => {
                membershipSelect.innerHTML += `<option value="${membership.id}" data-price="${membership.harga}" data-duration="${membership.durasi}">${membership.nama_paket_id || membership.nama_paket_en}</option>`;
            });
        }

        // Load trainers
        const trainerSelect = document.getElementById('trainer_id');
        trainerSelect.innerHTML = '<option value="">{{ __("Choose Trainer") }}</option>';
        if (productsData.trainers && Array.isArray(productsData.trainers)) {
            productsData.trainers.forEach(trainer => {
                trainerSelect.innerHTML += `<option value="${trainer.id}">${trainer.nama}</option>`;
            });
        }
    }

    function updateProductOptions() {
        const type = document.getElementById('transaction_type').value;
        hideAllProductSections();
        loadProductOptions();

        if (type === 'supplement') {
            document.getElementById('supplement-section').classList.remove('hidden');
            resetCalculations();
            // Reset supplements container
            const container = document.getElementById('supplements-container');
            const items = container.querySelectorAll('.supplement-item');
            items.forEach((item, index) => {
                if (index > 0) item.remove();
            });
            updateRemoveButtons();
        } else if (type === 'membership') {
            document.getElementById('membership-section').classList.remove('hidden');
            resetCalculations();
        } else if (type === 'contract') {
            document.getElementById('contract-section').classList.remove('hidden');
            resetCalculations();
        }
    }

    function addSupplementField(event) {
        event.preventDefault();
        const container = document.getElementById('supplements-container');
        const firstItem = container.querySelector('.supplement-item');
        const newItem = firstItem.cloneNode(true);
        
        // Reset values
        newItem.querySelector('.supplement-select').value = '';
        newItem.querySelector('.supplement-quantity').value = '1';
        newItem.querySelector('.supplement-stock').textContent = '0';
        
        container.appendChild(newItem);
        updateRemoveButtons();
        loadProductOptions();
    }

    function removeSupplementField(event) {
        event.preventDefault();
        const item = event.target.closest('.supplement-item');
        item.remove();
        updateRemoveButtons();
        updateSupplementsPrice();
    }

    function updateRemoveButtons() {
        const container = document.getElementById('supplements-container');
        const items = container.querySelectorAll('.supplement-item');
        
        items.forEach((item, index) => {
            const removeContainer = item.querySelector('.remove-supplement-container');
            if (items.length > 1) {
                removeContainer.classList.remove('hidden');
            } else {
                removeContainer.classList.add('hidden');
            }
        });
    }

    function updateSupplementsPrice() {
        const container = document.getElementById('supplements-container');
        const items = container.querySelectorAll('.supplement-item');
        let totalPrice = 0;

        items.forEach((item, index) => {
            const select = item.querySelector('.supplement-select');
            const quantityInput = item.querySelector('.supplement-quantity');
            const stockDisplay = item.querySelector('.supplement-stock');
            
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const stock = parseInt(selectedOption.getAttribute('data-stock')) || 0;
            const quantity = parseInt(quantityInput.value) || 1;

            stockDisplay.textContent = stock;

            if (quantity > stock) {
                alert('{{ __("Insufficient stock") }}');
                quantityInput.value = stock;
            }

            const itemTotal = price * quantity;
            totalPrice += itemTotal;
        });

        updateTotal(totalPrice);
    }

    function updateMembershipPrice() {
        const membershipSelect = document.getElementById('membership_id');
        const selectedOption = membershipSelect.options[membershipSelect.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const duration = selectedOption.getAttribute('data-duration') || '-';

        document.getElementById('membership-duration').textContent = duration;
        updateTotal(price);
    }

    function updateContractPrice() {
        const contractPriceInput = document.getElementById('contract_price');
        const price = parseFloat(contractPriceInput.value) || 0;
        updateTotal(price);
    }

    function updateTotal(amount) {
        const total = Math.round(amount);
        document.getElementById('calculated_total').textContent = total.toLocaleString('id-ID');
        document.getElementById('total').value = total;
    }

    function resetCalculations() {
        updateTotal(0);
    }

    function validateAddForm(event) {
        event.preventDefault();
        
        const id_akun = document.getElementById('id_akun').value;
        const transaction_type = document.getElementById('transaction_type').value;
        const metode_pembayaran = document.getElementById('metode_pembayaran').value;
        const status = document.getElementById('status').value;
        const total = parseInt(document.getElementById('total').value) || 0;

        console.log('Form Validation Started');
        console.log('ID Akun:', id_akun);
        console.log('Transaction Type:', transaction_type);
        console.log('Total:', total);
        console.log('Metode Pembayaran:', metode_pembayaran);
        console.log('Status:', status);

        if (!id_akun) {
            alert('{{ __("Please select an account") }}');
            return false;
        }

        if (!transaction_type) {
            alert('{{ __("Please select a transaction type") }}');
            return false;
        }

        if (transaction_type === 'supplement') {
            const items = document.querySelectorAll('.supplement-item');
            for (let item of items) {
                if (!item.querySelector('.supplement-select').value) {
                    alert('{{ __("Please select a supplement for all items") }}');
                    return false;
                }
            }
        } else if (transaction_type === 'membership') {
            if (!document.getElementById('membership_id').value) {
                alert('{{ __("Please select a membership plan") }}');
                return false;
            }
        } else if (transaction_type === 'contract') {
            if (!document.getElementById('trainer_id').value) {
                alert('{{ __("Please select a trainer") }}');
                return false;
            }
        }

        if (total <= 0) {
            alert('{{ __("Please select a valid product") }}');
            return false;
        }

        if (!metode_pembayaran) {
            alert('{{ __("Please select a payment method") }}');
            return false;
        }

        if (!status) {
            alert('{{ __("Please select a status") }}');
            return false;
        }

        console.log('Form Validation Passed - Submitting form');
        document.getElementById('addForm').submit();
        return false;
    }
</script>

<x-footer class="bg-gray-900 border-t border-gray-800" />
