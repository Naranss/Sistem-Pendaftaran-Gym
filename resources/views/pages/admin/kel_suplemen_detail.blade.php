<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.suplemen') }}" class="inline-flex items-center gap-2 text-red-600 hover:text-red-500 font-bold transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back to Supplements') }}
            </a>
        </div>

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                    <path d="M16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Supplement Details') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('View complete supplement information') }}</p>
        </div>

        <!-- Detail Card -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="p-8">
                <!-- Product Code & Name -->
                <div class="mb-8">
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Product Code') }}</p>
                        <p class="text-2xl font-bold text-white mt-2">SUP-{{ str_pad($suplemen->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Product Name') }}</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $suplemen->nama_suplemen }}</p>
                    </div>
                </div>

                <hr class="border-gray-700 my-8">

                <!-- Description -->
                <div class="mb-8">
                    <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Description') }}</p>
                    <p class="text-gray-300 mt-3 leading-relaxed">
                        @if($suplemen->deskripsi_suplemen)
                            {{ $suplemen->deskripsi_suplemen }}
                        @else
                            <span class="text-gray-500 italic">{{ __('No description provided') }}</span>
                        @endif
                    </p>
                </div>

                <hr class="border-gray-700 my-8">

                <!-- Price & Stock Information -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                    <!-- Price -->
                    <div class="bg-gray-700/50 rounded-lg p-6 border border-gray-600">
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Unit Price') }}</p>
                        <p class="text-2xl font-bold text-white mt-3">Rp {{ number_format($suplemen->harga, 0, ',', '.') }}</p>
                    </div>

                    <!-- Stock -->
                    <div class="bg-gray-700/50 rounded-lg p-6 border border-gray-600">
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Current Stock') }}</p>
                        @php
                            $stockClass = $suplemen->stok > 10 ? 'text-green-400' : ($suplemen->stok > 0 ? 'text-yellow-400' : 'text-red-400');
                            $stockBgClass = $suplemen->stok > 10 ? 'bg-green-900/30' : ($suplemen->stok > 0 ? 'bg-yellow-900/30' : 'bg-red-900/30');
                        @endphp
                        <div class="mt-3 inline-flex items-center gap-2 px-4 py-2 rounded-lg {{ $stockBgClass }}">
                            <span class="text-2xl font-bold {{ $stockClass }}">{{ $suplemen->stok }}</span>
                            <span class="text-xs {{ $stockClass }} uppercase font-semibold">
                                @if($suplemen->stok > 10)
                                    {{ __('Good') }}
                                @elseif($suplemen->stok > 0)
                                    {{ __('Low') }}
                                @else
                                    {{ __('Out of Stock') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Expiry Status -->
                    <div class="bg-gray-700/50 rounded-lg p-6 border border-gray-600">
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Expiry Status') }}</p>
                        @php
                            $expiryDate = \Carbon\Carbon::parse($suplemen->tanggal_kadaluarsa);
                            $daysLeft = intval(now()->diffInDays($expiryDate));
                            $isExpired = $daysLeft < 0;
                            $expiryClass = $isExpired ? 'text-red-400 bg-red-900/30' : ($daysLeft < 30 ? 'text-yellow-400 bg-yellow-900/30' : 'text-green-400 bg-green-900/30');
                        @endphp
                        <div class="mt-3 inline-flex flex-col">
                            <span class="text-2xl font-bold {{ $expiryClass }} px-4 py-2 rounded-lg">
                                {{ $expiryDate->format('d/m/Y') }}
                            </span>
                            <span class="text-xs {{ $expiryClass }} mt-2 px-4 py-1 rounded-lg uppercase font-semibold">
                                @if($isExpired)
                                    {{ __('Expired') }} ({{ abs($daysLeft) }} {{ __('days ago') }})
                                @elseif($daysLeft < 30)
                                    {{ __('Expiring Soon') }} ({{ $daysLeft }} {{ __('days left') }})
                                @else
                                    {{ __('Fresh') }} ({{ $daysLeft }} {{ __('days left') }})
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-700 my-8">

                <!-- Additional Information -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <!-- Created Date -->
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Created Date') }}</p>
                        <p class="text-gray-300 mt-2">{{ $suplemen->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Last Updated -->
                    <div>
                        <p class="text-sm font-medium text-gray-400 uppercase tracking-wider">{{ __('Last Updated') }}</p>
                        <p class="text-gray-300 mt-2">{{ $suplemen->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <hr class="border-gray-700 my-8">

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a 
                        href="{{ route('admin.suplemen') }}" 
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition duration-300 text-center"
                    >
                        {{ __('Back') }}
                    </a>
                    <button 
                        onclick="editSupplement({{ $suplemen->id }}, '{{ addslashes($suplemen->nama_suplemen) }}', {{ $suplemen->harga }}, {{ $suplemen->stok }}, '{{ addslashes($suplemen->deskripsi_suplemen) }}', '{{ $suplemen->tanggal_kadaluarsa }}')"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        {{ __('Edit') }}
                    </button>
                    <button 
                        onclick="deleteSupplement({{ $suplemen->id }}, '{{ addslashes($suplemen->nama_suplemen) }}')"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        {{ __('Delete') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script>
    function editSupplement(id, nama, harga, stok, deskripsi, tanggalKadaluarsa) {
        // Store data in sessionStorage and redirect to edit
        sessionStorage.setItem('editData', JSON.stringify({
            id, nama, harga, stok, deskripsi, tanggalKadaluarsa
        }));
        window.location.href = `{{ route('admin.suplemen') }}#edit-${id}`;
    }

    function deleteSupplement(id, nama) {
        if (confirm(`{{ __('Are you sure you want to delete supplement') }} "${nama}"?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('admin/suplemen') }}/${id}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
