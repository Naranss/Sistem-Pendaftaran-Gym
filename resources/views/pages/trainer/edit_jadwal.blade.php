<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-3xl font-bold text-white mb-8">{{ __('Class Schedule') }}</h1>

        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <form action="{{ route('trainer.jadwal.update') }}" method="POST">
                @csrf

                <table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Senin</th>
                            <th>Selasa</th>
                            <th>Rabu</th>
                            <th>Kamis</th>
                            <th>Jumat</th>
                            <th>Sabtu</th>
                            <th>Minggu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $grouped = $jadwal->groupBy('minggu_ke');
                        $days = [1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu', 7 => 'Minggu'];
                        @endphp

                        @foreach ($grouped as $minggu => $data)
                        <tr>
                            <td><strong>Minggu {{ $minggu }}</strong></td>
                            @foreach ($days as $hariNum => $hariNama)
                            @php
                            $workout = $data->firstWhere('hari', $hariNum);
                            @endphp
                            <td>
                                @if($workout)
                                <input class="text-black"
                                    type="text"
                                    name="jenis_workout[{{ $workout->id }}]"
                                    value="{{ $workout->jenis_workout }}"
                                    placeholder="Isi workout">
                                @else
                                <input class="text-black"
                                    type="text"
                                    name="new_workout[{{ $minggu }}][{{ $hariNum }}]"
                                    placeholder="Isi workout">
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>
                <button type="submit">Simpan Perubahan</button>
            </form>
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