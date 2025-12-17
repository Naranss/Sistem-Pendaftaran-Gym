<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Contract Payment') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Complete your trainer contract payment') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contract Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Contract Summary Card -->
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-6">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                        </svg>
                        {{ __('Contract Details') }}
                    </h2>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-700">
                            <div class="flex-grow">
                                <h3 class="text-white font-semibold text-lg">{{ $trainer->nama }}</h3>
                                <p class="text-gray-400 text-sm">{{ __('Personal Trainer') }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-700/30 rounded-lg p-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-300">{{ __('Email') }}:</span>
                                <span class="text-white font-semibold">{{ $trainer->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-300">{{ __('Phone') }}:</span>
                                <span class="text-white font-semibold">{{ $trainer->no_telp }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-300">{{ __('Monthly Rate') }}:</span>
                                <span class="text-red-400 font-bold">Rp {{ number_format($trainer->harga_kontrak, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="bg-yellow-900/20 border border-yellow-500/40 rounded-lg p-4">
                            <p class="text-yellow-200 text-sm">
                                <strong>{{ __('Contract Duration') }}:</strong> {{ __('1 Month (Auto-Renewal)') }}<br>
                                <strong>{{ __('Start Date') }}:</strong> {{ now()->format('d M Y') }}<br>
                                <strong>{{ __('End Date') }}:</strong> {{ now()->addMonth()->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contract Info Card -->
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
                        <div class="flex justify-between">
                            <span class="text-blue-200">{{ __('Contract ID') }}:</span>
                            <span class="text-white font-mono text-xs font-semibold">{{ $contract->id ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Summary Card -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-b from-red-800 to-red-900 rounded-xl shadow-lg border border-red-700 p-6 sticky top-4">
                    <h2 class="text-2xl font-bold text-white mb-6">{{ __('Payment Summary') }}</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-200">
                            <span>{{ __('Monthly Fee') }}</span>
                            <span>Rp {{ number_format($trainer->harga_kontrak, 0, ',', '.') }}</span>
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
                            <span>Rp {{ number_format($trainer->harga_kontrak, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button id="pay-button" 
                        class="w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg transform hover:scale-105">
                        {{ __('Pay Now') }}
                    </button>

                    <a href="{{ route('guest.trainer') }}"
                        class="block w-full px-6 py-3 mt-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white text-center rounded-lg font-bold transition duration-300">
                        {{ __('Cancel') }}
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
                console.log('Pay Now button clicked for contract');
                payButton.disabled = true;
                const processingText = '{{ __("Processing...") }}';
                payButton.textContent = processingText;

                // Call generatePayment endpoint to create transaction and snap token
                const contractId = @json($contract->id ?? null);
                const trainerId = @json($trainer->id ?? null);
                
                fetch('/contract/checkout/generate-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : ''
                    },
                    body: JSON.stringify({
                        contract_id: contractId,
                        trainer_id: trainerId
                    })
                })
                .then(response => {
                    console.log('Generate payment response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Generate payment response:', data);
                    
                    if (data.success && data.snap_token) {
                        const orderId = data.order_id;
                        
                        // Open Snap payment with the generated token
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                console.log('Payment success result:', result);
                                
                                // Call endpoint to update contract status after payment success
                                fetch('/contract/confirm-payment', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : ''
                                    },
                                    body: JSON.stringify({
                                        contract_id: contractId,
                                        order_id: orderId
                                    })
                                })
                                .then(res => res.json())
                                .then(confirmData => {
                                    console.log('Confirm payment response:', confirmData);
                                    alert('Payment successful! Your contract is now active.');
                                    window.location.href = '{{ route("guest.trainer") }}';
                                })
                                .catch(err => {
                                    console.error('Confirm payment error:', err);
                                    // Still redirect even if confirm fails, as payment was successful
                                    alert('Payment successful! Your contract is now active.');
                                    window.location.href = '{{ route("guest.trainer") }}';
                                });
                            },
                            onPending: function(result) {
                                console.log('Payment pending result:', result);
                                alert('Payment pending. We will notify you when payment is confirmed.');
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
                        const proceedText = '{{ __("Pay Now") }}';
                        payButton.textContent = proceedText;
                    }
                })
                .catch(err => {
                    alert('Failed to generate payment token: ' + err.message);
                    console.error('Payment generation error:', err);
                    payButton.disabled = false;
                    const proceedText = '{{ __("Pay Now") }}';
                    payButton.textContent = proceedText;
                });
            });
        }
    });
</script>
