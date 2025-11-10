<x-layout title="Jadwal Saya - Trainer">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-white mb-6">Jadwal Latihan Saya</h1>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-7 gap-4 mb-4">
                    @php
                        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    @endphp
                    @foreach($days as $day)
                        <div class="text-center font-semibold">{{ $day }}</div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-4">
                    @foreach($jadwal as $schedule)
                        <div class="bg-blue-100 rounded p-2 text-sm">
                            <p class="font-semibold">{{ $schedule->member->name }}</p>
                            <p class="text-gray-600">{{ $schedule->waktu }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold text-white mb-4">Permintaan Jadwal Baru</h2>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Loop through permintaan jadwal here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>