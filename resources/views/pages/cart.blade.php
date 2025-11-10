<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-gray-800 rounded-lg shadow-xl p-6">
            <h1 class="text-2xl font-bold text-white mb-6">{{ __('Shopping Cart') }}</h1>

            @if(count($cartItems) > 0)
                <div class="space-y-6">
                    {{-- Cart Items List --}}
                    <div class="divide-y divide-gray-700">
                        @foreach($cartItems as $item)
                            <div class="py-6 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    {{-- Suplemen doesn't have an image column in the migration; use a placeholder --}}
                                    <img src="{{ asset('assets/images/default.png') }}" 
                                         alt="{{ $item->suplemen->nama_suplemen }}"
                                         class="w-20 h-20 object-cover rounded-lg bg-gray-700 p-1">
                                    
                                    <div>
                                        <h3 class="text-lg font-medium text-white">{{ $item->suplemen->nama_suplemen }}</h3>
                                        <p class="text-sm text-gray-400">{{ __('Price') }}: Rp {{ number_format($item->suplemen->harga, 0, ',', '.') }}</p>
                                        
                                        {{-- Quantity Selector --}}
                                        <div class="flex items-center mt-2">
                                            <button onclick="updateQuantity('{{ $item->id }}', 'decrease')"
                                                    class="bg-gray-700 text-white px-2 py-1 rounded-l hover:bg-gray-600 transition">
                                                -
                                            </button>
                                            <span class="bg-gray-700 text-white px-4 py-1">{{ $item->jumlah_produk ?? 1 }}</span>
                                            <button onclick="updateQuantity('{{ $item->id }}', 'increase')"
                                                    class="bg-gray-700 text-white px-2 py-1 rounded-r hover:bg-gray-600 transition">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <p class="text-lg font-medium text-white">
                                        Rp {{ number_format(($item->suplemen->harga ?? $item->harga_produk) * ($item->jumlah_produk ?? 1), 0, ',', '.') }}
                                    </p>
                                    
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-300 text-sm transition">
                                            {{ __('Remove') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Cart Summary --}}
                    <div class="border-t border-gray-700 pt-6 mt-6">
                        <div class="flex justify-between items-center text-lg font-medium text-white mb-6">
                            <span>{{ __('Total') }}</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('homepage') }}" 
                               class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                                {{ __('Continue Shopping') }}
                            </a>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    {{ __('Proceed to Checkout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty Cart State --}}
                <div class="text-center py-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <h3 class="text-xl font-medium text-white mb-2">{{ __('Your cart is empty') }}</h3>
                    <p class="text-gray-400 mb-6">{{ __('Add some items to your cart to proceed with checkout') }}</p>
                    <a href="{{ route('homepage') }}" 
                       class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        {{ __('Start Shopping') }}
                    </a>
                </div>
            @endif
        </div>
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