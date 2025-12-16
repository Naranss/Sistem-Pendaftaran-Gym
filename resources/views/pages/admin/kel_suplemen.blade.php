<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                        <path d="M16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Manage Supplements') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Manage supplement products and inventory') }}</p>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/30 border border-green-500/50 rounded-lg text-green-300">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 rounded-lg text-red-300">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search and Add Button -->
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <form method="GET" action="{{ route('admin.suplemen') }}" class="flex-1 flex gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="{{ __('Search supplements...') }}" 
                        class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600 transition"
                    >
                </div>
                <button 
                    type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center gap-2 whitespace-nowrap"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Search') }}
                </button>
                @if(request('search'))
                    <a 
                        href="{{ route('admin.suplemen') }}" 
                        class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition duration-300"
                    >
                        {{ __('Reset') }}
                    </a>
                @endif
            </form>
            <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Add Supplement') }}
            </button>
        </div>

        <!-- Table -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Product Code') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Product Name') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Price') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Stock') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Expiry Date') }}
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse ($suplemen as $item)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                    SUP-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->nama_suplemen }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-white">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $stockClass = $item->stok > 10 ? 'text-green-400' : ($item->stok > 0 ? 'text-yellow-400' : 'text-red-400');
                                    @endphp
                                    <span class="{{ $stockClass }} font-semibold">{{ $item->stok }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $expiryDate = \Carbon\Carbon::parse($item->tanggal_kadaluarsa);
                                        $daysLeft = now()->diffInDays($expiryDate);
                                        $statusClass = $daysLeft < 0 ? 'text-red-400' : ($daysLeft < 30 ? 'text-yellow-400' : 'text-green-400');
                                    @endphp
                                    <span class="{{ $statusClass }} font-semibold">
                                        {{ $expiryDate->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <a 
                                            href="{{ route('admin.suplemen.show', $item->id) }}"
                                            class="text-green-400 hover:text-green-300 transition-colors flex items-center gap-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            {{ __('View') }}
                                        </a>
                                        <button 
                                            onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->nama_suplemen) }}', {{ $item->harga }}, {{ $item->stok }}, '{{ addslashes($item->deskripsi_suplemen) }}', '{{ $item->tanggal_kadaluarsa }}')"
                                            class="text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            {{ __('Edit') }}
                                        </button>
                                        <button 
                                            onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama_suplemen) }}')"
                                            class="text-red-400 hover:text-red-300 transition-colors flex items-center gap-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <p>{{ __('No supplement data found') }}</p>
                                        @if(request('search'))
                                            <p class="text-sm mt-1">{{ __('Try searching with different keywords') }}</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($suplemen->hasPages())
                <div class="bg-gray-700 px-6 py-4 border-t border-gray-600">
                    <div class="text-white">
                        {{ $suplemen->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

{{-- Add Modal --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">{{ __('Add Supplement') }}</h2>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="addForm" method="POST" action="{{ route('admin.suplemen.store') }}" enctype="multipart/form-data" onsubmit="return validateAddForm()">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Supplement Name') }}</label>
                    <input type="text" name="nama_suplemen" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Description') }}</label>
                    <textarea name="deskripsi_suplemen" rows="3" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Image') }}</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-600 file:text-white hover:file:bg-red-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Price') }}</label>
                    <input type="number" name="harga" min="0" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Stock') }}</label>
                    <input type="number" name="stok" min="0" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Expiry Date') }}</label>
                    <input type="date" name="tanggal_kadaluarsa" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">{{ __('Cancel') }}</button>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">{{ __('Edit Supplement') }}</h2>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Supplement Name') }}</label>
                    <input type="text" id="edit_nama" name="nama_suplemen" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Description') }}</label>
                    <textarea id="edit_deskripsi" name="deskripsi_suplemen" rows="3" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Image') }}</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Price') }}</label>
                    <input type="number" id="edit_harga" name="harga" required min="0" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Stock') }}</label>
                    <input type="number" id="edit_stok" name="stok" required min="0" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">{{ __('Expiry Date') }}</label>
                    <input type="date" id="edit_tanggal_kadaluarsa" name="tanggal_kadaluarsa" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">{{ __('Cancel') }}</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
</div>

<x-footer class="bg-gray-900 border-t border-gray-800" />

<script>
    function openAddModal() {
        document.getElementById('addModal').classList.remove('hidden');
        document.getElementById('addModal').classList.add('flex');
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.add('hidden');
        document.getElementById('addModal').classList.remove('flex');
    }

    function openEditModal(id, nama, harga, stok, deskripsi, tanggalKadaluarsa) {
        document.getElementById('editForm').action = `{{ url('admin/suplemen') }}/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_stok').value = stok;
        document.getElementById('edit_deskripsi').value = deskripsi || '';
        document.getElementById('edit_tanggal_kadaluarsa').value = tanggalKadaluarsa || '';
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function confirmDelete(id, nama) {
        if (confirm(`Apakah Anda yakin ingin menghapus suplemen "${nama}"?`)) {
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

    function validateAddForm() {
        const nama = document.querySelector('#addForm input[name="nama_suplemen"]').value.trim();
        const harga = document.querySelector('#addForm input[name="harga"]').value.trim();
        const stok = document.querySelector('#addForm input[name="stok"]').value.trim();
        const tanggal = document.querySelector('#addForm input[name="tanggal_kadaluarsa"]').value.trim();

        // Check if all fields are filled
        if (!nama) {
            alert('Nama Suplemen harus diisi');
            return false;
        }
        if (!harga || harga <= 0) {
            alert('Harga harus diisi dan lebih dari 0');
            return false;
        }
        if (!stok || stok < 0) {
            alert('Stok harus diisi');
            return false;
        }
        if (!tanggal) {
            alert('Tanggal Kadaluarsa harus diisi');
            return false;
        }

        return true;
    }
</script>
