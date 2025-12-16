<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Manage Accounts') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Manage all user accounts in the system') }}</p>
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
            <form method="GET" action="{{ route('admin.akun') }}" class="flex-1 flex gap-4">
                <div class="flex-1">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="{{ __('Search accounts...') }}"
                        class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600 transition">
                </div>
                <button
                    type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center gap-2 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Search') }}
                </button>
                @if(request('search'))
                <a
                    href="{{ route('admin.akun') }}"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-bold transition duration-300">
                    {{ __('Reset') }}
                </a>
                @endif
            </form>
            <button onclick="openAddModal()" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-bold transition duration-300 flex items-center justify-center gap-2 whitespace-nowrap">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                {{ __('Add Account') }}
            </button>
        </div>

        <!-- Table -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                KODE AKUN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NAMA AKUN PENGGUNA
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                NOMOR HP
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                TANGGAL PENDAFTARAN
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                ACTION
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse ($akun as $item)
                        <tr class="hover:bg-gray-750 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white">
                                AKN-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                <div class="flex items-center gap-2">
                                    <span>{{ $item->nama }}</span>
                                    @if($item->role)
                                    <span class="px-2 py-0.5 text-xs rounded {{ $item->role === 'ADMIN' ? 'bg-purple-900 text-purple-300' : ($item->role === 'TRAINER' ? 'bg-blue-900 text-blue-300' : ($item->role === 'MEMBER' ? 'bg-green-900 text-green-300' : 'bg-gray-900 text-gray-300')) }}">
                                        {{ $item->role }}
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ $item->no_telp ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-3">
                                    <button
                                        onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->nama) }}', '{{ $item->email }}', '{{ $item->no_telp ?? '' }}', '{{ $item->jenis_kelamin ?? '' }}', '{{ $item->role }}')"
                                        class="text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </button>
                                    @if(Auth::id() != $item->id)
                                    <button
                                        onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->nama) }}')"
                                        class="text-red-400 hover:text-red-300 transition-colors flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                    @else
                                    <span class="text-gray-500 text-xs">Akun sendiri</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <p>Tidak ada data akun ditemukan</p>
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
            @if($akun->hasPages())
            <div class="bg-gray-700 px-6 py-4 border-t border-gray-600">
                <div class="text-white">
                    {{ $akun->appends(request()->query())->links() }}
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
            <h2 class="text-xl font-bold text-white">Tambah Akun</h2>
            <button onclick="closeAddModal()" class="text-gray-400 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form id="addForm" method="POST" action="{{ route('admin.akun.store') }}" onsubmit="return validateAddForm()">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="text" name="email" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nomor HP</label>
                    <input type="text" name="no_telp" inputmode="numeric" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="LAKI-LAKI">Laki-Laki</option>
                        <option value="PEREMPUAN">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                    <select name="role" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Role</option>
                        <option value="PENGUNJUNG">Pengunjung</option>
                        <option value="MEMBER">Member</option>
                        <option value="TRAINER">Trainer</option>
                        <option value="ADMIN">Admin</option>
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
    <div class="bg-gray-800 rounded-lg p-6 w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Edit Akun</h2>
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
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                    <input type="text" id="edit_nama" name="nama" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" id="edit_email" name="email" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" id="edit_password" name="password" minlength="8" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Nomor HP</label>
                    <input type="text" id="edit_no_telp" name="no_telp" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Jenis Kelamin</label>
                    <select id="edit_jenis_kelamin" name="jenis_kelamin" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="LAKI-LAKI">Laki-Laki</option>
                        <option value="PEREMPUAN">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                    <select id="edit_role" name="role" required class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                        <option value="">Pilih Role</option>
                        <option value="PENGUNJUNG">Pengunjung</option>
                        <option value="MEMBER">Member</option>
                        <option value="TRAINER">Trainer</option>
                        <option value="ADMIN">Admin</option>
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

    function openEditModal(id, nama, email, noTelp, jenisKelamin, role) {
        document.getElementById('editForm').action = `{{ url('admin/akun') }}/${id}`;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_telp').value = noTelp || '';
        document.getElementById('edit_jenis_kelamin').value = jenisKelamin || '';
        document.getElementById('edit_role').value = role || '';
        document.getElementById('edit_password').value = '';
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
    }

    function confirmDelete(id, nama) {
        if (confirm(`Apakah Anda yakin ingin menghapus akun "${nama}"?`)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('admin/akun') }}/${id}`;

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
        const nama = document.querySelector('#addForm input[name="nama"]').value.trim();
        const email = document.querySelector('#addForm input[name="email"]').value.trim();
        const password = document.querySelector('#addForm input[name="password"]').value.trim();
        const noTelp = document.querySelector('#addForm input[name="no_telp"]').value.trim();
        const jenisKelamin = document.querySelector('#addForm select[name="jenis_kelamin"]').value;
        const role = document.querySelector('#addForm select[name="role"]').value;

        // Check if all fields are filled
        if (!nama) {
            alert('Nama harus diisi');
            return false;
        }
        if (!email) {
            alert('Email harus diisi');
            return false;
        }
        if (!password) {
            alert('Password harus diisi');
            return false;
        }
        if (!noTelp) {
            alert('Nomor HP harus diisi');
            return false;
        }
        if (!jenisKelamin) {
            alert('Jenis Kelamin harus dipilih');
            return false;
        }
        if (!role) {
            alert('Role harus dipilih');
            return false;
        }

        // Validate email format with @
        if (!email.includes('@')) {
            alert('Email harus mengandung simbol @');
            return false;
        }

        // Validate phone number (10-12 digits)
        const phoneRegex = /^\d{10,12}$/;
        if (!phoneRegex.test(noTelp)) {
            alert('Nomor HP harus antara 10-12 angka');
            return false;
        }

        // Validate password length
        if (password.length < 8) {
            alert('Password harus minimal 8 karakter');
            return false;
        }

        return true;
    }
</script>