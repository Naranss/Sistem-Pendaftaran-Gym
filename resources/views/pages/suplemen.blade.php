<x-navbar />

<section class="py-12">
    <div class="container mx-auto px-6 max-w-6xl">

        <h2 class="text-3xl font-bold mb-6">{{ __('Supplements') }}</h2>

        <!-- Cards grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-6">
            @foreach ($supplements as $supplement)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300">
                <!-- Image div here -->
                <div></div>
                <!-- Supplement name and price -->
                <div class="p-6 space-y-3">
                    <h3 class="text-xl font-semibold text-gray-800">{{ $supplement->nama_suplemen }}</h3>
                    <p class="text-blue-600 font-semibold">Rp
                        {{ number_format($supplement->harga, 0, ',', '.') }} / hour
                    </p>
                    <a href="{{ route('suplemen.show', $supplement->id) }}"
                        class="inline-block bg-blue-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        {{ __('Order')}}
                    </a>
                </div>
            </div>
            @endforeach

            @if (count($supplements) === 0)
            <p class="text-gray-500 col-span-full text-center">No supplements found.</p>
            @endif

        </div>
        {{ $supplements->withQueryString()->links() }}
    </div>
</section>

<x-footer class="bg-gray-900 border-t border-gray-800" />