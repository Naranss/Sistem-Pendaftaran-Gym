<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Shopping Cart') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Review your items before checkout') }}</p>
        </div>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    {{-- Cart Items List --}}
                    @foreach($cartItems as $item)
                        @if($item->suplemen)
                        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-4 hover:border-red-600/50 transition">
                            <div class="flex items-start gap-4">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/images/default.png') }}" 
                                         alt="{{ $item->suplemen->nama_suplemen }}"
                                         class="w-24 h-24 object-cover rounded-lg bg-gray-700 border border-gray-600">
                                </div>
                                
                                <!-- Product Info -->
                                <div class="flex-grow">
                                    <h3 class="text-lg font-bold text-white mb-1">{{ $item->suplemen->nama_suplemen }}</h3>
                                    <p class="text-red-500 font-bold text-lg mb-3">Rp {{ number_format($item->suplemen->harga, 0, ',', '.') }}</p>
                                    
                                    <!-- Quantity Selector -->
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-400 text-sm">{{ __('Quantity') }}:</span>
                                        <div class="flex items-center bg-gray-700/50 rounded-lg border border-gray-600">
                                            <button onclick="updateQuantity('{{ $item->id }}', 'decrease')"
                                                    class="px-3 py-2 text-white hover:bg-gray-600 transition font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <span class="px-4 py-2 text-white font-semibold min-w-[3rem] text-center">{{ $item->jumlah_produk ?? 1 }}</span>
                                            <button onclick="updateQuantity('{{ $item->id }}', 'increase')"
                                                    class="px-3 py-2 text-white hover:bg-gray-600 transition font-bold">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price & Remove -->
                                <div class="text-right flex flex-col items-end gap-4">
                                    <div>
                                        <p class="text-gray-400 text-sm">{{ __('Subtotal') }}</p>
                                        <p class="text-2xl font-bold text-white">
                                            Rp {{ number_format(($item->suplemen->harga ?? $item->harga_produk) * ($item->jumlah_produk ?? 1), 0, ',', '.') }}
                                        </p>
                                    </div>
                                    
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-300 text-sm font-semibold transition flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @elseif($item->membership)
                            {{-- Membership Item --}}
                            <div class="bg-gradient-to-b from-blue-800 to-blue-900 rounded-xl shadow-lg border border-blue-700 p-4 hover:border-blue-600/50 transition">
                                <div class="flex items-start gap-4">
                                    <!-- Membership Icon -->
                                    <div class="flex-shrink-0 bg-blue-700/50 rounded-lg p-3 border border-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </div>
                                    
                                    <!-- Membership Info -->
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-bold text-white mb-1">
                                            @if($item->membership === 'bulanan')
                                                {{ __('Monthly Membership') }}
                                            @elseif($item->membership === 'per3bulan')
                                                {{ __('3 Months Membership') }}
                                            @elseif($item->membership === 'tahunan')
                                                {{ __('Yearly Membership') }}
                                            @else
                                                {{ __('Membership') }}
                                            @endif
                                        </h3>
                                        <p class="text-blue-300 font-semibold text-sm mb-2">{{ __('Premium access to all facilities') }}</p>
                                        <p class="text-blue-400 font-bold text-lg">Rp {{ number_format($item->harga_membership, 0, ',', '.') }}</p>
                                    </div>

                                    <!-- Price & Remove -->
                                    <div class="text-right flex flex-col items-end gap-4">
                                        <div>
                                            <p class="text-gray-300 text-sm">{{ __('Subtotal') }}</p>
                                            <p class="text-2xl font-bold text-white">
                                                Rp {{ number_format($item->harga_membership * ($item->jumlah_produk ?? 1), 0, ',', '.') }}
                                            </p>
                                        </div>
                                        
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-400 hover:text-red-300 text-sm font-semibold transition flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                {{ __('Remove') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40 rounded-xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        <div>
                                            <p class="text-white font-semibold">{{ __('Product no longer available') }}</p>
                                            <p class="text-sm text-red-300">{{ __('This item has been removed from inventory') }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition text-sm font-semibold">
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-red-900/30 to-red-900/10 border border-red-500/30 rounded-xl p-6 sticky top-4 space-y-6">
                        <h2 class="text-xl font-bold text-white flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            {{ __('Order Summary') }}
                        </h2>

                        <!-- Items Count -->
                        <div class="bg-gray-800/50 rounded-lg p-3 border border-gray-700">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400">{{ __('Items') }}:</span>
                                <span class="font-bold text-white">{{ count($cartItems) }} {{ count($cartItems) == 1 ? __('item') : __('items') }}</span>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="space-y-3 border-t border-red-500/30 pt-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">{{ __('Subtotal') }}</span>
                                <span class="text-white font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400">{{ __('Shipping') }}</span>
                                <span class="text-white font-semibold">{{ __('Free') }}</span>
                            </div>
                            <div class="border-t border-red-500/30 pt-3 flex justify-between items-center text-lg">
                                <span class="text-white font-bold">{{ __('Total') }}</span>
                                <span class="text-red-500 font-bold text-2xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="space-y-3 pt-4 border-t border-red-500/30">
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                    {{ __('Proceed to Checkout') }}
                                </button>
                            </form>
                            
                            <a href="{{ route('suplemen') }}" 
                               class="block w-full px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white text-center rounded-lg font-bold transition duration-300">
                                {{ __('Continue Shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart State --}}
            <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-20 w-20 text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <h3 class="text-3xl font-bold text-white mb-2">{{ __('Your cart is empty') }}</h3>
                <p class="text-gray-400 mb-8">{{ __('Add some items to your cart to proceed with checkout') }}</p>
                <a href="{{ route('suplemen') }}" 
                   class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                    </svg>
                    {{ __('Start Shopping') }}
                </a>
            </div>
        @endif
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

@push('scripts')
<script>
function updateQuantity(itemId, action) {
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ action: action })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    });
}
</script>
@endpush