<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-6xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a2 2 0 012-2h8a2 2 0 012 2v9a2 2 0 01-2 2H8a2 2 0 01-2-2V7z" clip-rule="evenodd" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Edit Schedule') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Manage your weekly training schedule') }}</p>
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

        <!-- Schedule Form -->
        <form action="{{ route('trainer.jadwal.update' ) }}" method="POST" class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl border border-gray-700 p-8 mb-8">
            @csrf

            <!-- Schedule Grid -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-600">
                            <th class="text-left px-4 py-3 text-gray-300 font-semibold">{{ __('Week') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Monday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Tuesday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Wednesday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Thursday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Friday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Saturday') }}</th>
                            <th class="text-center px-4 py-3 text-gray-300 font-semibold">{{ __('Sunday') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        @php
                            $grouped = $jadwal->groupBy('minggu_ke');
                            $days = [1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat', 7 => 'Sun'];
                        @endphp

                        @foreach($grouped as $minggu => $data)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-4 py-3 font-semibold text-white">
                                    {{ __('Week') }} {{ $minggu }}
                                </td>
                                @foreach($days as $hariNum => $hariNama)
                                    @php
                                        $workout = $data->firstWhere('hari', $hariNum);
                                    @endphp
                                    <td class="px-4 py-3 text-center">
                                        @if($workout)
                                            <input class="w-full bg-gray-700 border border-gray-600 text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent"
                                                type="text"
                                                name="jenis_workout[{{ $workout->id }}]"
                                                value="{{ $workout->jenis_workout }}"
                                                placeholder="e.g., Push-ups">
                                        @else
                                            <input class="w-full bg-gray-700 border border-gray-600 text-white rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent"
                                                type="text"
                                                name="new_workout[{{ $minggu }}][{{ $hariNum }}]"
                                                placeholder="Rest day">
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-4 mt-8">
                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-lg font-bold transition duration-300 shadow-lg flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    {{ __('Save Changes') }}
                </button>
                <a href="{{ route('trainer.jadwal') }}" class="px-6 py-3 bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white rounded-lg font-bold transition duration-300 shadow-lg flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>

        <!-- Info Box -->
        <div class="bg-gradient-to-r from-blue-900/30 to-blue-900/10 border border-blue-500/30 rounded-xl p-6">
            <div class="flex gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 8a1 1 0 000 2h6a1 1 0 100-2H8zm0 4a1 1 0 100 2h3a1 1 0 100-2H8z" clip-rule="evenodd" />
                </svg>
                <div>
                    <h3 class="text-white font-semibold mb-1">{{ __('Schedule Tips') }}</h3>
                    <p class="text-blue-300 text-sm">{{ __('Enter the type of exercise for each day (e.g., Cardio, Strength Training, Yoga). Leave blank for rest days.') }}</p>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />