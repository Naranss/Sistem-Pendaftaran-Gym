<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Membership Plans') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Choose the perfect plan for your fitness journey') }}</p>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-900/30 to-green-900/10 border border-green-500/40 rounded-xl p-4 mb-8 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="text-green-300">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-900/30 to-red-900/10 border border-red-500/40 rounded-xl p-4 mb-8 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                <span class="text-red-300">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Current Membership Status --}}
        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8 mb-12">
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 000-2H5a1 1 0 00-1 1v1H3a1 1 0 000 2h1v1a1 1 0 002 0V4h1a1 1 0 000-2H6V2a1 1 0 01-1-1zm0 0a2 2 0 00-2 2v2a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 4a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2V8a2 2 0 00-2-2H5z" />
                </svg>
                <h2 class="text-2xl font-bold text-white">{{ __('Your Current Status') }}</h2>
            </div>
            
            @if($akun)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    {{-- Status --}}
                    <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                        <p class="text-gray-400 text-sm mb-2">{{ __('Status') }}</p>
                        <p class="text-2xl font-bold 
                            @if($status_membership === 'aktif') text-green-400
                            @elseif($status_membership === 'expired') text-red-400
                            @else text-gray-400
                            @endif
                            flex items-center gap-2">
                            @if($status_membership === 'aktif')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Active') }}
                            @elseif($status_membership === 'expired')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Expired') }}
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13 6a1 1 0 11-2 0 1 1 0 012 0zM7 9a1 1 0 11-2 0 1 1 0 012 0zm8 0a1 1 0 11-2 0 1 1 0 012 0zM9 15a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Inactive') }}
                            @endif
                        </p>
                    </div>

                    {{-- Start Date --}}
                    @if($akun->membership_start)
                        <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                            <p class="text-gray-400 text-sm mb-2">{{ __('Start Date') }}</p>
                            <p class="text-lg font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($akun->membership_start)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    {{-- End Date --}}
                    @if($akun->membership_end)
                        <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 rounded-lg p-4 border border-gray-600">
                            <p class="text-gray-400 text-sm mb-2">{{ __('End Date') }}</p>
                            <p class="text-lg font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                                </svg>
                                {{ \Carbon\Carbon::parse($akun->membership_end)->format('d M Y') }}
                            </p>
                        </div>
                    @endif

                    {{-- Days Remaining --}}
                    @if($status_membership === 'aktif' && $akun->membership_end)
                        <div class="bg-gradient-to-br from-yellow-900/30 to-yellow-900/10 rounded-lg p-4 border border-yellow-600/40">
                            <p class="text-gray-400 text-sm mb-2">{{ __('Days Remaining') }}</p>
                            <p class="text-2xl font-bold text-yellow-400 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3.586L7.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 10.586V7z" clip-rule="evenodd" />
                                </svg>
                                {{ intval(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($akun->membership_end))) }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ __('days') }}</p>
                        </div>
                    @endif
                </div>
            @else
                <p class="text-gray-400">{{ __('No membership information found.') }}</p>
            @endif
        </div>

        {{-- Membership Plans --}}
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                    <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                </svg>
                <h2 class="text-2xl font-bold text-white">{{ __('Choose Your Plan') }}</h2>
            </div>
            
            <form action="{{ route('member.membership.update') }}" method="POST" id="membershipForm">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    @php
                        $locale = session('locale', 'id');
                    @endphp
                    
                    @forelse($membershipPlans as $plan)
                        @php
                            // Determine plan duration and get the type for form submission
                            $durasi = $plan->durasi; // e.g., "1" for monthly, "3" for 3 months, "12" for yearly
                            
                            // Determine membership type based on duration
                            if ($durasi == 1) {
                                $membershipPlanId = 'bulanan';
                                $isBestValue = false;
                                $savings = null;
                            } elseif ($durasi == 3) {
                                $membershipPlanId = 'per3bulan';
                                $isBestValue = true;
                                $savings = 'Rp 100.000';
                            } elseif ($durasi == 12) {
                                $membershipPlanId = 'tahunan';
                                $isBestValue = false;
                                $savings = 'Rp 600.000';
                            } else {
                                $membershipPlanId = 'custom_' . $durasi;
                                $isBestValue = false;
                                $savings = null;
                            }
                            
                            // Get localized name and description
                            $namaRencana = $locale === 'id' ? $plan->nama_paket_id : $plan->nama_paket_en;
                            $deskripsi = $locale === 'id' ? $plan->deskripsi_id : $plan->deskripsi_en;
                            
                            // Parse deskripsi (assuming it's JSON array or comma-separated)
                            $deskripsiArray = [];
                            if (is_string($deskripsi)) {
                                // Try to parse as JSON first
                                if (json_validate($deskripsi)) {
                                    $deskripsiArray = json_decode($deskripsi, true);
                                } else {
                                    // Fallback: split by newline or comma
                                    $deskripsiArray = array_map('trim', preg_split('/[\n,]/', $deskripsi));
                                }
                            } elseif (is_array($deskripsi)) {
                                $deskripsiArray = $deskripsi;
                            }
                        @endphp
                        
                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl overflow-hidden shadow-lg border {{ $isBestValue ? 'border-2 border-red-500' : 'border border-gray-700 hover:border-red-600/50' }} transform hover:scale-105 transition duration-300 cursor-pointer membership-card" 
                             data-membership="{{ $membershipPlanId }}" 
                             data-price="{{ $plan->harga }}"
                             data-plan-id="{{ $plan->id }}">
                            
                            <div class="p-6 h-full flex flex-col justify-between">
                                <div>
                                    <h3 class="text-2xl font-bold text-white mb-3">{{ $namaRencana }}</h3>
                                    <div class="text-3xl font-bold text-red-500 mb-2">
                                        Rp {{ number_format($plan->harga, 0, ',', '.') }}
                                        <span class="text-sm text-gray-400 font-normal block">/{{ $durasi }} {{ $durasi == 1 ? __('month') : __('months') }}</span>
                                    </div>
                                    @if($savings && $isBestValue)
                                        <p class="text-xs text-green-400 font-semibold mb-6">{{ __('Hemat') }} {{ $savings }}</p>
                                    @elseif($savings)
                                        <p class="text-xs text-green-400 font-semibold mb-6">{{ __('Hemat') }} {{ $savings }}</p>
                                    @endif
                                    
                                    <ul class="space-y-2 mb-6 text-sm text-gray-300">
                                        @forelse($deskripsiArray as $item)
                                            @if(!empty($item))
                                                <li class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ trim($item, '"') }}
                                                </li>
                                            @endif
                                        @empty
                                            <li class="flex items-center gap-2">
                                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                                {{ __('Premium features included') }}
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="border-2 border-green-500/50 rounded-lg p-3 text-center membership-selected hidden bg-green-900/30">
                                    <div class="flex items-center justify-center gap-2 flex-wrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-green-400 font-semibold text-sm">{{ __('Selected') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 bg-yellow-900/20 border border-yellow-600/40 rounded-lg p-8 text-center">
                            <p class="text-yellow-300">{{ __('No membership plans available at the moment.') }}</p>
                        </div>
                    @endforelse
                </div>

                <input type="hidden" name="membership" id="membership_type" required>
                <input type="hidden" name="harga_membership" id="harga_membership" required>

                <div class="flex gap-4">
                    <button type="submit" 
                            class="flex-1 px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg flex items-center justify-center gap-2"
                            id="submitBtn"
                            disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        {{ __('Proceed to Payment') }}
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
        const membershipForm = document.getElementById('membershipForm');

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

        // Handle form submission - redirect to payment details page
        membershipForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const membershipType = membershipTypeInput.value;
            const price = hargaMembershipInput.value;
            const selectedCard = document.querySelector('.membership-card.border-green-500');
            const planId = selectedCard ? selectedCard.dataset.planId : '';
            
            if (membershipType && price && planId) {
                // Redirect to membership payment details page with query parameters
                window.location.href = `{{ route('membership.payment') }}?type=${encodeURIComponent(membershipType)}&price=${encodeURIComponent(price)}&plan_id=${encodeURIComponent(planId)}`;
            }
        });
    });
</script>

