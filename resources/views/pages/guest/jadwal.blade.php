<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Class Schedule') }}</h1>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th></th>
                        <th>{{ __('Senin') }}</th>
                        <th>{{ __('Selasa') }}</th>
                        <th>{{ __('Rabu') }}</th>
                        <th>{{ __('Kamis') }}</th>
                        <th>{{ __('Jumat') }}</th>
                        <th>{{ __('Sabtu') }}</th>
                        <th>{{ __('Minggu') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    // Group data by minggu_ke
                    $grouped = $jadwalWorkout->groupBy('minggu_ke');
                    $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                    @endphp

                    @foreach ($grouped as $minggu => $data)
                    <tr>
                        <td><strong>{{ __('Minggu') }} {{ $minggu }}</strong></td>
                        @foreach ($days as $hariNum => $hariNama)
                        @php
                        $workout = $data->firstWhere('hari', $hariNum);
                        @endphp
                        <td>{{ $workout ? $workout->jenis_workout : '-' }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <div class="mt-12 text-center">
            <p class="text-lg text-gray-400 mb-6">{{ __('Want to join our exciting classes?') }}</p>
            <a href="{{ route('register') }}" class="inline-block bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                {{ __('Register Now') }}
            </a>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />