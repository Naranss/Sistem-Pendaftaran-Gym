<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-8">
    <div class="container mx-auto px-6">
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

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Kelola Alat Gym</h1>
            <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Alat Gym
            </button>
        </div>

        {{-- Search Bar --}}
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.alat-gym') }}" class="flex gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Cari alat gym..." 
                        class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                    >
                </div>
                <button 
                    type="submit" 
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300 flex items-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
                @if(request('search'))
                    <a 
                        href="{{ route('admin.alat-gym') }}" 
                        class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold transition duration-300"
                    >
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                KODE ALAT GYM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NAMA ALAT GYM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                KONDISI
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                TANGGAL PENGINPUTAN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse ($alatGym as $item)
                            <tr class="hover:bg-gray-750 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                    ALG-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->nama_alat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    @php
                                        $kondisiClass = match($item->kondisi) {
                                            'Baik' => 'bg-green-900 text-green-300',
                                            'Rusak Ringan' => 'bg-yellow-900 text-yellow-300',
                                            'Rusak Berat' => 'bg-orange-900 text-orange-300',
                                            'Perbaikan' => 'bg-blue-900 text-blue-300',
                                            default => 'bg-gray-900 text-gray-300'
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded {{ $kondisiClass }}">
                                        {{ $item->kondisi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-3">
                                        <button 
                                            onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->nama_alat) }}', '{{ $item->kondisi }}')"
                                            class="text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button 
                                            onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama_alat) }}')"
                                            class="text-red-400 hover:text-red-300 transition-colors flex items-center gap-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <p>Tidak ada data alat gym ditemukan</p>
                                        @if(request('search'))
                                            <p class="text-sm mt-1">Coba cari dengan kata kunci lain</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                        </div>

            {{-- Pagination --}}
            @if($alatGym->hasPages())
                <div class="bg-gray-700 px-6 py-4 border-t border-gray-600">
                    <div class="text-white">
                        {{ $alatGym->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>

{{-- Add Modal --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Tambah Alat Gym</h2>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="addForm" method="POST" action="{{ route('admin.alat-gym.store') }}" onsubmit="return validateAddForm()">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Alat Gym</label>
                    <input type="text" name="nama_alat" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Kondisi</label>
                    <select name="kondisi" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                        <option value="Perbaikan">Perbaikan</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeAddModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Modal --}}
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Edit Alat Gym</h2>
            <button onclick="closeEditModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama Alat Gym</label>
                    <input type="text" id="edit_nama" name="nama_alat" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Kondisi</label>
                    <select id="edit_kondisi" name="kondisi" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Rusak Ringan">Rusak Ringan</option>
                        <option value="Rusak Berat">Rusak Berat</option>
                        <option value="Perbaikan">Perbaikan</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Update</button>
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

    function openEditModal(id, nama, kondisi) {
        document.getElementById('editForm').action = `{{ url('admin/alat-gym') }}/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_kondisi').value = kondisi;
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function confirmDelete(id, nama) {
        if (confirm(`Apakah Anda yakin ingin menghapus alat gym "${nama}"?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('admin/alat-gym') }}/${id}`;
            
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
        const form = document.getElementById('addForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return false;
        }
        return true;
    }
</script>
