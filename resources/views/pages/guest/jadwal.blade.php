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
            <!-- Legend -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-br from-blue-900/40 to-blue-900/20 border border-blue-500/30 rounded-lg p-3">
                    <p class="text-blue-300 text-sm font-semibold">💪 {{ __('Strength') }}</p>
                </div>
                <div class="bg-gradient-to-br from-purple-900/40 to-purple-900/20 border border-purple-500/30 rounded-lg p-3">
                    <p class="text-purple-300 text-sm font-semibold">🏃 {{ __('Cardio') }}</p>
                </div>
                <div class="bg-gradient-to-br from-green-900/40 to-green-900/20 border border-green-500/30 rounded-lg p-3">
                    <p class="text-green-300 text-sm font-semibold">🧘 {{ __('Yoga') }}</p>
                </div>
                <div class="bg-gradient-to-br from-pink-900/40 to-pink-900/20 border border-pink-500/30 rounded-lg p-3">
                    <p class="text-pink-300 text-sm font-semibold">💃 {{ __('HIIT') }}</p>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto mb-8">
                <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-300 uppercase tracking-wider border-b border-gray-700">
                                    {{ __('Week') }}
                                </th>
                                @php
                                    $days = [
                                        1 => ['name' => 'Senin', 'emoji' => '🔵'],
                                        2 => ['name' => 'Selasa', 'emoji' => '🟢'],
                                        3 => ['name' => 'Rabu', 'emoji' => '🟡'],
                                        4 => ['name' => 'Kamis', 'emoji' => '🟠'],
                                        5 => ['name' => 'Jumat', 'emoji' => '🔴'],
                                        6 => ['name' => 'Sabtu', 'emoji' => '🟣'],
                                        7 => ['name' => 'Minggu', 'emoji' => '⚫']
                                    ];
                                @endphp
                                @foreach($days as $dayNum => $dayInfo)
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-300 uppercase tracking-wider border-b border-gray-700">
                                        <div class="text-lg">{{ $dayInfo['emoji'] }}</div>
                                        <div>{{ __($dayInfo['name']) }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @php
                                $grouped = $jadwalWorkout->groupBy('minggu_ke');
                                $maxWeeks = $grouped->count();
                            @endphp
                            @foreach($grouped as $minggu => $data)
                                <tr class="hover:bg-gray-700/30 transition duration-200">
                                    <td class="px-6 py-6 whitespace-nowrap font-bold text-white border-r border-gray-700">
                                        <div class="inline-flex items-center gap-2 bg-red-900/40 border border-red-500/30 rounded-lg px-3 py-1">
                                            <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                            {{ __('Week') }} {{ $minggu }}
                                        </div>
                                    </td>
                                    @foreach($days as $hariNum => $dayInfo)
                                        @php
                                            $workout = $data->firstWhere('hari', $hariNum);
                                            $jenisWorkout = $workout ? $workout->jenis_workout : null;
                                            
                                            // Determine color based on workout type
                                            $colors = [
                                                'strength' => 'blue',
                                                'cardio' => 'purple',
                                                'yoga' => 'green',
                                                'hiit' => 'pink',
                                            ];
                                            
                                            $colorKey = strtolower($jenisWorkout ?? '');
                                            $color = $colors[$colorKey] ?? 'gray';
                                        @endphp
                                        <td class="px-6 py-6 text-center border-r border-gray-700 last:border-r-0">
                                            @if($workout)
                                                <div class="bg-gradient-to-br from-{{ $color }}-900/40 to-{{ $color }}-900/20 border border-{{ $color }}-500/40 rounded-lg p-3 backdrop-blur">
                                                    <p class="text-{{ $color }}-300 font-bold text-sm">{{ $jenisWorkout }}</p>
                                                    @if($workout->waktu_mulai && $workout->waktu_selesai)
                                                        <p class="text-{{ $color }}-400 text-xs mt-2">
                                                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00-.293.707l-2.414 2.414a1 1 0 101.414 1.414L9 11.414V6z" clip-rule="evenodd" /></svg>
                                                            {{ $workout->waktu_mulai ?? '' }} - {{ $workout->waktu_selesai ?? '' }}
                                                        </p>
                                                    @endif
                                                    @if($workout->instruktur)
                                                        <p class="text-{{ $color }}-400 text-xs mt-1">
                                                            <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" /></svg>
                                                            {{ $workout->instruktur }}
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="text-gray-500 font-semibold text-lg">-</div>
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
                        <div class="bg-gradient-to-r from-red-900/40 to-red-900/20 border-b border-gray-700 px-4 py-3">
                            <div class="inline-flex items-center gap-2 bg-red-900/60 border border-red-500/40 rounded-lg px-3 py-1">
                                <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                <span class="text-red-300 font-bold">{{ __('Week') }} {{ $minggu }}</span>
                            </div>
                        </div>

                        <!-- Days Grid -->
                        <div class="grid grid-cols-7 divide-x divide-gray-700">
                            @foreach($days as $hariNum => $dayInfo)
                                @php
                                    $workout = $data->firstWhere('hari', $hariNum);
                                    $jenisWorkout = $workout ? $workout->jenis_workout : null;
                                    
                                    $colors = [
                                        'strength' => ['bg' => 'blue-900/40', 'border' => 'blue-500/40', 'text' => 'blue-300'],
                                        'cardio' => ['bg' => 'purple-900/40', 'border' => 'purple-500/40', 'text' => 'purple-300'],
                                        'yoga' => ['bg' => 'green-900/40', 'border' => 'green-500/40', 'text' => 'green-300'],
                                        'hiit' => ['bg' => 'pink-900/40', 'border' => 'pink-500/40', 'text' => 'pink-300'],
                                    ];
                                    
                                    $colorKey = strtolower($jenisWorkout ?? '');
                                    $colorScheme = $colors[$colorKey] ?? ['bg' => 'gray-700', 'border' => 'gray-600', 'text' => 'gray-300'];
                                @endphp
                                <div class="p-3">
                                    <p class="text-xs font-semibold text-gray-400 mb-2">{{ $dayInfo['emoji'] }} {{ __($dayInfo['name']) }}</p>
                                    @if($workout)
                                        <div class="bg-{{ $colorScheme['bg'] }} border border-{{ $colorScheme['border'] }} rounded p-2">
                                            <p class="text-{{ $colorScheme['text'] }} text-xs font-bold">{{ $jenisWorkout }}</p>
                                            @if($workout->waktu_mulai)
                                                <p class="text-{{ $colorScheme['text'] }} text-xs mt-1 opacity-75">{{ substr($workout->waktu_mulai, 0, 5) }}</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-gray-600 font-semibold text-center text-lg">-</div>
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