<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Checkout') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Review and confirm your order') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Summary Card -->
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-6">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                        </svg>
                        {{ __('Order Items') }}
                    </h2>

                    <div class="space-y-4">
                        @forelse($cartItems as $item)
                            <div class="flex items-center justify-between pb-4 border-b border-gray-700">
                                <div class="flex-grow">
                                    @if($item->suplemen)
                                        <h3 class="text-white font-semibold">{{ $item->suplemen->nama_suplemen }}</h3>
                                        <p class="text-gray-400 text-sm">{{ __('Quantity') }}: {{ $item->jumlah_produk ?? 1 }}</p>
                                    @elseif($item->membership)
                                        <h3 class="text-white font-semibold">
                                            @if($item->membership === 'bulanan')
                                                {{ __('Monthly Membership') }}
                                            @elseif($item->membership === 'per3bulan')
                                                {{ __('3 Months Membership') }}
                                            @elseif($item->membership === 'tahunan')
                                                {{ __('Yearly Membership') }}
                                            @else
                                                {{ ucfirst($item->membership) }} {{ __('Membership') }}
                                            @endif
                                        </h3>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <p class="text-red-400 font-bold">
                                        Rp {{ number_format(($item->suplemen?->harga ?? $item->harga_membership ?? 0) * ($item->jumlah_produk ?? 1), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 py-4">{{ __('No items in your order') }}</p>
                        @endforelse
                    </div>
                </div>

                <!-- Order Info Card -->
                <div class="bg-gradient-to-b from-blue-800 to-blue-900 rounded-xl shadow-lg border border-blue-700 p-6">
                    <h2 class="text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm6 5a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Order Information') }}
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-blue-200">{{ __('Customer') }}:</span>
                            <span class="text-white font-semibold">{{ Auth::user()->nama }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-blue-200">{{ __('Email') }}:</span>
                            <span class="text-white font-semibold">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-blue-200">{{ __('Order Date') }}:</span>
                            <span class="text-white font-semibold">{{ now()->format('d M Y H:i') }}</span>
                        </div>
                        @if($transaction)
                            <div class="flex justify-between">
                                <span class="text-blue-200">{{ __('Order ID') }}:</span>
                                <span class="text-white font-mono text-xs">{{ $transaction->order_id }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Payment Summary Card -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-b from-red-800 to-red-900 rounded-xl shadow-lg border border-red-700 p-6 sticky top-4">
                    <h2 class="text-2xl font-bold text-white mb-6">{{ __('Order Summary') }}</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-200">
                            <span>{{ __('Subtotal') }}</span>
                            <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-200">
                            <span>{{ __('Tax') }}</span>
                            <span>Rp 0</span>
                        </div>
                        <div class="flex justify-between text-gray-200">
                            <span>{{ __('Shipping') }}</span>
                            <span>Rp 0</span>
                        </div>
                        <hr class="border-red-700 my-4">
                        <div class="flex justify-between text-white text-xl font-bold">
                            <span>{{ __('Total') }}</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                        <button id="pay-button" 
                            class="w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg transform hover:scale-105">
                            {{ __('Proceed to Payment') }}
                        </button>

                    <a href="{{ route('cart.index') }}"
                        class="block w-full px-6 py-3 mt-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white text-center rounded-lg font-bold transition duration-300">
                        {{ __('Back to Cart') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const payButton = document.getElementById('pay-button');

        if (payButton) {
            payButton.addEventListener('click', function() {
                console.log('Proceed to Payment button clicked');
                payButton.disabled = true;
                const processingText = '{{ __("Processing...") }}';
                payButton.textContent = processingText;

                // Call generatePayment endpoint to create transaction and snap token
                fetch('/checkout/generate-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : ''
                    }
                })
                .then(response => {
                    console.log('Generate payment response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Generate payment response:', data);
                    
                    if (data.success && data.snap_token) {
                        // Open Snap payment with the generated token
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success result:', result);
                                alert('Payment successful! Please wait while we process your order.');
                                window.location.href = '{{ route("guest.riwayat") }}';
                            },
                            onPending: function(result) {
                                console.log('Payment pending result:', result);
                                alert('Payment pending. We will notify you when payment is confirmed. You can view your transaction in the history.');
                                window.location.href = '{{ route("guest.riwayat") }}';
                            },
                            onError: function(result) {
                                console.log('Payment error result:', result);
                                alert('Payment failed! You can retry from the transaction history.');
                                window.location.href = '{{ route("guest.riwayat") }}';
                            },
                            onClose: function() {
                                console.log('Payment popup closed');
                                // Redirect to history if popup closed without completing
                                window.location.href = '{{ route("guest.riwayat") }}';
                            }
                        });
                    } else {
                        alert('Failed to generate payment token: ' + (data.message || 'Unknown error'));
                        payButton.disabled = false;
                        const proceedText = '{{ __("Proceed to Payment") }}';
                        payButton.textContent = proceedText;
                    }
                })
                .catch(err => {
                    alert('Failed to generate payment token: ' + err.message);
                    console.error('Payment generation error:', err);
                    payButton.disabled = false;
                    const proceedText = '{{ __("Proceed to Payment") }}';
                    payButton.textContent = proceedText;
                });
            });
        }
    });
</script>
