<x-navbar />

<!-- Supplement details -->
<section class="bg-white shadow rounded-xl p-6 mb-6">
    <div class="max-w-6xl mx-auto flex flex-col lg:flex-row gap-8">
        <!-- Left: gambar Carousel and Info -->
        <div class="w-full lg:w-2/3 space-y-4">
            <div class="relative overflow-hidden rounded-xl" x-data="carousel()">
                <div class="flex transition-transform duration-500" x-ref="carouselContainer"
                    :style="{ transform: `translateX(-${activeIndex * 100}%)` }">
                    @foreach ($suplemen->gambarSuplemen as $gambar)
                    <img src="{{ asset('storage/' . $gambar->path) }}" class="w-full h-80 object-cover"
                        alt="{{ $gambar->img_alt }}" />
                    @endforeach
                </div>
                <button @click="prevgambar"
                    class="absolute top-1/2 left-2 -translate-y-1/2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">‹</button>
                <button @click="nextgambar"
                    class="absolute top-1/2 right-2 -translate-y-1/2 bg-black bg-opacity-50 text-white px-2 py-1 rounded">›</button>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $suplemen->nama_suplemen }}</h1>
                <div class="mt-4 text-gray-700">
                    <h3 class="font-semibold mb-1">Description</h3>
                    <p class="text-sm leading-relaxed">{{ $suplemen->deskripsi_suplemen }}</p>
                </div>
            </div>
        </div>

        <!-- Right: Price and Booking Button -->
        <div class="w-full lg:w-1/3">
            <div class="bg-gray-50 p-6 rounded-xl border shadow-sm space-y-4">
                <p class="text-gray-500 text-sm">Starting from</p>
                <h2 class="text-2xl font-bold text-gray-800">Rp {{ number_format($suplemen->harga, 0, ',', '.') }}
                    <span class="text-base font-medium text-gray-500">/ Session</span>
                </h2>
                <a href="#bookingSection"
                    class="block bg-blue-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-blue-700 transition">Check
                    Availability</a>

                <div class="border-t pt-4 text-sm text-gray-600 space-y-2">
                    <p>✅ Down payment (DP) option</p>
                    <p>✅ Reschedule booking*</p>
                    <p>✅ More promos & vouchers in the app</p>
                </div>
            </div>
        </div>
    </div>

</section>

<x-footer class="bg-gray-900 border-t border-gray-800" />