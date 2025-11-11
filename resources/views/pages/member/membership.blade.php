<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Update Membership') }}</h1>

        @if(session('success'))
            <div class="bg-green-500 text-white px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        {{-- Current Membership Status --}}
        <div class="bg-gray-800 rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-white mb-4">{{ __('Current Membership Status') }}</h2>
            
            @if($akun)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-gray-400 mb-1">{{ __('Status') }}</p>
                        <p class="text-lg font-semibold 
                            @if($status_membership === 'aktif') text-green-500
                            @elseif($status_membership === 'expired') text-red-500
                            @else text-gray-400
                            @endif">
                            @if($status_membership === 'aktif')
                                {{ __('Active') }}
                            @elseif($status_membership === 'expired')
                                {{ __('Expired') }}
                            @else
                                {{ __('Inactive') }}
                            @endif
                        </p>
                    </div>

                    @if($akun->membership_start)
                        <div>
                            <p class="text-gray-400 mb-1">{{ __('Start Date') }}</p>
                            <p class="text-lg font-semibold text-white">
                                {{ \Carbon\Carbon::parse($akun->membership_start)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    @if($akun->membership_end)
                        <div>
                            <p class="text-gray-400 mb-1">{{ __('End Date') }}</p>
                            <p class="text-lg font-semibold text-white">
                                {{ \Carbon\Carbon::parse($akun->membership_end)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    @if($status_membership === 'aktif' && $akun->membership_end)
                        <div>
                            <p class="text-gray-400 mb-1">{{ __('Days Remaining') }}</p>
                            <p class="text-lg font-semibold text-yellow-400">
                                {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($akun->membership_end)) }} {{ __('days') }}
                            </p>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-gray-400">{{ __('No membership information found.') }}</p>
            @endif
        </div>

        {{-- Membership Plans --}}
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-white mb-6">{{ __('Choose Your Membership Plan') }}</h2>
            
            <form action="{{ route('member.membership.update') }}" method="POST" id="membershipForm">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    {{-- Monthly Plan --}}
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                         data-membership="bulanan" 
                         data-price="300000">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-4">{{ __('Monthly') }}</h3>
                            <div class="text-3xl font-bold text-red-500 mb-4">
                                Rp 300.000
                                <span class="text-lg text-gray-400 font-normal">/month</span>
                            </div>
                            <ul class="space-y-2 mb-4 text-sm text-gray-300">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Access to all equipment') }}
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Locker access') }}
                                </li>
                            </ul>
                            <div class="border-2 border-transparent rounded p-2 text-center membership-selected hidden">
                                <span class="text-green-500 font-semibold">{{ __('Selected') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- 3 Months Plan --}}
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 cursor-pointer membership-card border-2 border-red-500" 
                         data-membership="per3bulan" 
                         data-price="800000">
                        <div class="bg-red-500 text-white text-center py-1 text-sm">
                            {{ __('Best Value') }}
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-4">{{ __('3 Months') }}</h3>
                            <div class="text-3xl font-bold text-red-500 mb-4">
                                Rp 800.000
                                <span class="text-lg text-gray-400 font-normal">/3 months</span>
                            </div>
                            <ul class="space-y-2 mb-4 text-sm text-gray-300">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('All monthly features') }}
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Save Rp 100.000') }}
                                </li>
                            </ul>
                            <div class="border-2 border-transparent rounded p-2 text-center membership-selected hidden">
                                <span class="text-green-500 font-semibold">{{ __('Selected') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Yearly Plan --}}
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                         data-membership="tahunan" 
                         data-price="3000000">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white mb-4">{{ __('Yearly') }}</h3>
                            <div class="text-3xl font-bold text-red-500 mb-4">
                                Rp 3.000.000
                                <span class="text-lg text-gray-400 font-normal">/year</span>
                            </div>
                            <ul class="space-y-2 mb-4 text-sm text-gray-300">
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('All features included') }}
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Save Rp 600.000') }}
                                </li>
                            </ul>
                            <div class="border-2 border-transparent rounded p-2 text-center membership-selected hidden">
                                <span class="text-green-500 font-semibold">{{ __('Selected') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="membership" id="membership_type" required>
                <input type="hidden" name="harga_membership" id="harga_membership" required>

                <div class="bg-gray-800 rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold text-white mb-4">{{ __('Payment Method') }}</h3>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="transfer" class="mr-3" checked>
                            <span class="text-gray-300">{{ __('Bank Transfer') }}</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="cash" class="mr-3">
                            <span class="text-gray-300">{{ __('Cash') }}</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="metode_pembayaran" value="e-wallet" class="mr-3">
                            <span class="text-gray-300">{{ __('E-Wallet') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            id="submitBtn"
                            disabled>
                        {{ __('Update Membership') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const membershipCards = document.querySelectorAll('.membership-card');
        const membershipTypeInput = document.getElementById('membership_type');
        const hargaMembershipInput = document.getElementById('harga_membership');
        const submitBtn = document.getElementById('submitBtn');

        membershipCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                membershipCards.forEach(c => {
                    c.classList.remove('border-green-500');
                    c.querySelector('.membership-selected').classList.add('hidden');
                });

                // Add selected class to clicked card
                this.classList.add('border-green-500');
                this.querySelector('.membership-selected').classList.remove('hidden');

                // Set form values
                membershipTypeInput.value = this.dataset.membership;
                hargaMembershipInput.value = this.dataset.price;

                // Enable submit button
                submitBtn.disabled = false;
            });
        });
    });
</script>

