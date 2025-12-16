<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6 max-w-7xl">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <h1 class="text-4xl font-bold text-white">{{ __('Supplements') }}</h1>
                </div>
                <a href="{{ route('homepage') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-bold transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Back') }}
                </a>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Premium quality supplements to support your fitness goals') }}</p>
        </div>

        {{-- Search Bar --}}
        <div class="mb-8">
            <form method="GET" action="{{ route('suplemen') }}" class="flex gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="{{ __('Search supplements...') }}"
                            class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute right-3 top-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <button
                    type="submit"
                    class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    {{ __('Search') }}
                </button>
                @if(request('search'))
                <a
                    href="{{ route('suplemen') }}"
                    class="bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 shadow-lg">
                    {{ __('Reset') }}
                </a>
                @endif
            </form>
        </div>

        <!-- Cards grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            @foreach ($supplements as $supplement)
            <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-700 hover:border-red-600/50 group flex flex-col">
                <!-- Image container with overlay -->
                <div class="relative w-full h-48 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center overflow-hidden flex-shrink-0">
                    @if($supplement->gambarSuplemen->count())
                    <img
                        src="{{ asset($supplement->gambarSuplemen->first()->path) }}"
                        alt="{{ $supplement->gambarSuplemen->first()->img_alt }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-600 group-hover:text-gray-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    @endif

                    <!-- Stock badge -->
                    @if($supplement->stok > 0)
                    <div class="absolute top-3 right-3 bg-green-600/80 backdrop-blur-sm border border-green-400/30 rounded-full px-3 py-1 text-xs font-bold text-white flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ $supplement->stok }}
                    </div>
                    @else
                    <div class="absolute top-3 right-3 bg-red-600/80 backdrop-blur-sm border border-red-400/30 rounded-full px-3 py-1 text-xs font-bold text-white">
                        {{ __('Out of Stock') }}
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-4 flex flex-col flex-grow justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-1 line-clamp-2 group-hover:text-red-400 transition">{{ $supplement->nama_suplemen }}</h3>
                        <p class="text-red-500 font-bold text-lg">Rp {{ number_format($supplement->harga, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('suplemen.show', ['supplement' => $supplement->id]) }}" class="mt-4 w-full inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-center font-semibold py-3 px-4 rounded-lg transition duration-300 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('View Details') }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        @if (count($supplements) === 0)
        <!-- Empty State -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-12 text-center border border-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <h3 class="text-2xl font-bold text-white mb-2">{{ __('No Supplements Found') }}</h3>
            <p class="text-gray-400 mb-6">{{ __('Try adjusting your search criteria') }}</p>
            <a href="{{ route('suplemen') }}" class="inline-block bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-8 py-3 rounded-lg font-bold transition duration-300 shadow-lg">
                {{ __('View All Products') }}
            </a>
        </div>
        @endif

        <!-- Pagination -->
        <div class="mt-8">
            {{ $supplements->withQueryString()->links() }}
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />