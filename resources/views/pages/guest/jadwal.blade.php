<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Class Schedule') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Join our exciting fitness classes throughout the week') }}</p>
        </div>

        @if($jadwalWorkout && $jadwalWorkout->count() > 0)

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto mb-8">
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700">
                            <tr>
                                <th class="px-8 py-5 text-left text-sm font-bold text-white uppercase tracking-wider">
                                    {{ __('Week') }}
                                </th>
                                @php
                                    $days = [
                                        1 => 'Senin',
                                        2 => 'Selasa',
                                        3 => 'Rabu',
                                        4 => 'Kamis',
                                        5 => 'Jumat',
                                        6 => 'Sabtu',
                                        7 => 'Minggu'
                                    ];
                                @endphp
                                @foreach($days as $dayNum => $dayName)
                                    <th class="px-8 py-5 text-center text-sm font-bold text-white uppercase tracking-wider border-l border-gray-700">
                                        {{ __($dayName) }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @php
                                $grouped = $jadwalWorkout->groupBy('minggu_ke');
                            @endphp
                            @foreach($grouped as $minggu => $data)
                                <tr class="hover:bg-gray-700/20 transition duration-200">
                                    <td class="px-8 py-6 whitespace-nowrap font-bold text-white border-r border-gray-700">
                                        <span class="inline-block px-4 py-2 bg-red-600/15 border border-red-500/30 rounded text-red-300 text-sm font-semibold">
                                            Week {{ $minggu }}
                                        </span>
                                    </td>
                                    @foreach($days as $hariNum => $dayName)
                                        @php
                                            $workout = $data->firstWhere('hari', $hariNum);
                                            $jenisWorkout = $workout ? $workout->jenis_workout : null;
                                            
                                            $colors = [
                                                'strength' => 'blue',
                                                'cardio' => 'purple',
                                                'yoga' => 'green',
                                                'hiit' => 'pink',
                                            ];
                                            
                                            $colorKey = strtolower($jenisWorkout ?? '');
                                            $color = $colors[$colorKey] ?? 'gray';
                                        @endphp
                                        <td class="px-8 py-6 text-center border-r border-gray-700 last:border-r-0">
                                            @if($workout)
                                                <div class="bg-{{ $color }}-900/20 border border-{{ $color }}-500/40 rounded p-4">
                                                    <p class="text-{{ $color }}-300 font-bold text-sm capitalize mb-2">{{ $jenisWorkout }}</p>
                                                    @if($workout->waktu_mulai && $workout->waktu_selesai)
                                                        <p class="text-{{ $color }}-400 text-xs font-medium">
                                                            {{ $workout->waktu_mulai ?? '' }} - {{ $workout->waktu_selesai ?? '' }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-sm font-medium">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden space-y-4 mb-8">
                @php
                    $grouped = $jadwalWorkout->groupBy('minggu_ke');
                @endphp
                @foreach($grouped as $minggu => $data)
                    <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700">
                        <!-- Week Header -->
                        <div class="bg-gray-700 border-b border-gray-600 px-6 py-4">
                            <span class="inline-block px-4 py-2 bg-red-600/15 border border-red-500/30 rounded text-red-300 text-sm font-semibold">
                                Week {{ $minggu }}
                            </span>
                        </div>

                        <!-- Days Grid -->
                        <div class="space-y-3 p-6">
                            @foreach($days as $hariNum => $dayName)
                                @php
                                    $workout = $data->firstWhere('hari', $hariNum);
                                    $jenisWorkout = $workout ? $workout->jenis_workout : null;
                                    
                                    $colors = [
                                        'strength' => ['bg' => 'blue-900/20', 'border' => 'blue-500/40', 'text' => 'blue-300'],
                                        'cardio' => ['bg' => 'purple-900/20', 'border' => 'purple-500/40', 'text' => 'purple-300'],
                                        'yoga' => ['bg' => 'green-900/20', 'border' => 'green-500/40', 'text' => 'green-300'],
                                        'hiit' => ['bg' => 'pink-900/20', 'border' => 'pink-500/40', 'text' => 'pink-300'],
                                    ];
                                    
                                    $colorKey = strtolower($jenisWorkout ?? '');
                                    $colorScheme = $colors[$colorKey] ?? ['bg' => 'gray-700/20', 'border' => 'gray-600', 'text' => 'gray-300'];
                                @endphp
                                <div class="border border-gray-700 rounded-lg p-4">
                                    <p class="text-sm font-semibold text-gray-300 mb-3 uppercase tracking-wide">{{ __($dayName) }}</p>
                                    @if($workout)
                                        <div class="bg-{{ $colorScheme['bg'] }} border border-{{ $colorScheme['border'] }} rounded p-3">
                                            <p class="text-{{ $colorScheme['text'] }} text-sm font-bold capitalize mb-2">{{ $jenisWorkout }}</p>
                                            @if($workout->waktu_mulai && $workout->waktu_selesai)
                                                <p class="text-{{ $colorScheme['text'] }} text-xs font-medium">
                                                    {{ $workout->waktu_mulai ?? '' }} - {{ $workout->waktu_selesai ?? '' }}
                                                </p>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-500 text-sm font-medium">No class scheduled</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-red-900/40 to-red-900/20 border border-red-500/30 rounded-xl p-8 text-center">
                <h2 class="text-2xl font-bold text-white mb-3">{{ __('Ready to Transform Your Body?') }}</h2>
                <p class="text-gray-300 mb-6">{{ __('Join our community and start your fitness journey today!') }}</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                        {{ __('Register Now') }}
                    </a>
                    <a href="{{ route('suplemen') }}" class="inline-block bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                        {{ __('Browse Products') }}
                    </a>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Schedule Available') }}</h3>
                <p class="text-gray-400 mb-6">{{ __('The workout schedule is being prepared. Check back soon!') }}</p>
                <a href="{{ route('register') }}" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                    {{ __('Register to Get Notified') }}
                </a>
            </div>
        @endif
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />