<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Complete Membership Payment') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Finish your membership registration') }}</p>
        </div>

        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg border border-gray-700 p-8">
            <!-- Membership Details -->
            <div class="mb-8 pb-8 border-b border-gray-700">
                <h2 class="text-2xl font-bold text-white mb-6">{{ __('Membership Details') }}</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">{{ __('Plan Name') }}:</span>
                        <span class="text-white font-semibold">{{ $selectedPlan->nama_paket_id ?? $selectedPlan->nama_paket_en ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">{{ __('Duration') }}:</span>
                        <span class="text-white font-semibold">
                            @if($selectedPlan)
                                {{ $selectedPlan->durasi }} {{ $selectedPlan->durasi == 1 ? __('month') : __('months') }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">{{ __('Order ID') }}:</span>
                        <span class="text-white font-mono text-sm">{{ $orderId }}</span>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-600 pt-4 mt-4">
                        <span class="text-gray-300 font-semibold">{{ __('Total Amount') }}:</span>
                        <span class="text-red-400 font-bold text-xl">Rp {{ number_format($price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">{{ __('Status') }}:</span>
                        <span class="px-3 py-1 bg-yellow-900/30 text-yellow-300 rounded-full text-sm font-semibold">{{ __('Pending') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">{{ __('Order Date') }}:</span>
                        <span class="text-white">{{ now()->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Button -->
            <div class="space-y-4">
                <button id="pay-button" 
                    class="w-full px-6 py-4 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg transform hover:scale-105">
                    {{ __('Pay Now') }}
                </button>

                <a href="{{ route('guest.membership') }}"
                    class="block w-full px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white text-center rounded-lg font-bold transition duration-300">
                    {{ __('Back to Membership') }}
                </a>
            </div>

            <!-- Info Message -->
            <div class="mt-8 p-4 bg-blue-900/20 border border-blue-700 rounded-lg">
                <p class="text-blue-200 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 000 2h6a1 1 0 000-2H8zm6 5a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Complete your payment to activate your membership') }}
                </p>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const snapToken = '{{ $snapToken }}';
        const payButton = document.getElementById('pay-button');
        const orderId = '{{ $orderId }}';
        const planId = '{{ $planId }}';
        const price = '{{ $price }}';

        if (payButton) {
            payButton.addEventListener('click', function() {
                console.log('Pay button clicked');
                payButton.disabled = true;
                payButton.textContent = '{{ __("Processing...") }}';

                window.snap.pay(snapToken, {
                    onSuccess: function(result) {
                        console.log('Payment success result:', result);
                        
                        // Confirm the membership payment
                        fetch('{{ route("membership.confirm-payment") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                plan_id: planId,
                                price: price
                            })
                        })
                        .then(response => {
                            console.log('Response status:', response.status);
                            if (!response.ok) {
                                throw new Error('HTTP error, status = ' + response.status);
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            if (data.success) {
                                // Show success message
                                Swal.fire({
                                    title: '{{ __("Success") }}',
                                    text: '{{ __("Your membership has been activated successfully!") }}',
                                    icon: 'success',
                                    confirmButtonText: '{{ __("OK") }}',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                    didOpen: () => {
                                        // Auto-redirect after 2 seconds
                                        setTimeout(() => {
                                            console.log('Auto-redirecting to membership page');
                                            window.location.href = '{{ route("guest.membership") }}';
                                        }, 2000);
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        console.log('SweetAlert confirmed, redirecting...');
                                        // Redirect to membership page after payment success
                                        window.location.href = '{{ route("guest.membership") }}';
                                    }
                                });
                            } else {
                                payButton.disabled = false;
                                payButton.textContent = '{{ __("Pay Now") }}';
                                console.error('Confirmation failed:', data.message);
                                Swal.fire({
                                    title: '{{ __("Error") }}',
                                    text: data.message || '{{ __("Payment confirmation failed") }}',
                                    icon: 'error',
                                    confirmButtonText: '{{ __("OK") }}'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            payButton.disabled = false;
                            payButton.textContent = '{{ __("Pay Now") }}';
                            Swal.fire({
                                title: '{{ __("Error") }}',
                                text: '{{ __("An error occurred during payment confirmation") }}: ' + error.message,
                                icon: 'error',
                                confirmButtonText: '{{ __("OK") }}'
                            });
                        });
                    },
                    onPending: function(result) {
                        console.log('Payment pending:', result);
                        // Create transaction for pending payment
                        fetch('{{ route("membership.confirm-payment") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                plan_id: planId,
                                price: price,
                                status: 'pending'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Pending transaction created:', data);
                            Swal.fire({
                                title: '{{ __("Payment Pending") }}',
                                text: '{{ __("Your payment is being processed. You can check the status in your transaction history.") }}',
                                icon: 'info',
                                confirmButtonText: '{{ __("View History") }}'
                            }).then(() => {
                                // Redirect to transaction history
                                window.location.href = '{{ route("guest.riwayat") }}';
                            });
                        })
                        .catch(error => {
                            console.error('Error creating pending transaction:', error);
                        });
                    },
                    onError: function(result) {
                        console.error('Payment error:', result);
                        payButton.disabled = false;
                        payButton.textContent = '{{ __("Pay Now") }}';
                        Swal.fire({
                            title: '{{ __("Payment Failed") }}',
                            text: '{{ __("There was an error processing your payment") }}',
                            icon: 'error',
                            confirmButtonText: '{{ __("Try Again") }}'
                        });
                    },
                    onClose: function() {
                        console.log('Payment popup closed');
                        // Create pending transaction even if user closes the popup
                        fetch('{{ route("membership.confirm-payment") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: orderId,
                                plan_id: planId,
                                price: price,
                                status: 'pending'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log('Pending transaction created from popup close:', data);
                            Swal.fire({
                                title: '{{ __("Payment Incomplete") }}',
                                text: '{{ __("Your transaction has been saved. You can complete the payment later from your transaction history.") }}',
                                icon: 'info',
                                confirmButtonText: '{{ __("View History") }}'
                            }).then(() => {
                                // Redirect to transaction history
                                window.location.href = '{{ route("guest.riwayat") }}';
                            });
                        })
                        .catch(error => {
                            console.error('Error creating pending transaction on close:', error);
                            // Still redirect to history even if transaction creation fails
                            payButton.disabled = false;
                            payButton.textContent = '{{ __("Pay Now") }}';
                            window.location.href = '{{ route("guest.riwayat") }}';
                        });
                    }
                });
            });
        }
    });
</script>
