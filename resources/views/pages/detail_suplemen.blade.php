<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6 max-w-7xl">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-900/40 to-green-900/20 border border-green-500/40 text-green-200 px-6 py-4 rounded-lg flex items-start gap-3">
                <svg class="w-6 h-6 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                <div>
                    <h3 class="font-bold">{{ __('Success') }}</h3>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Product Details -->
        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl overflow-hidden border border-gray-700 mb-8">
            <div class="flex flex-col lg:flex-row gap-8 p-8">
                <!-- Left: Image Carousel -->
                <div class="w-full lg:w-2/3 space-y-6">
                    <!-- Header -->
                    <div class="mb-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <h1 class="text-3xl font-bold text-white">{{ $suplemen->nama_suplemen }}</h1>
                        </div>
                    </div>

                    <div class="relative overflow-hidden rounded-xl bg-gray-900" x-data="{ activeIndex: 0 }">
                        @if(isset($suplemen->gambarSuplemen) && count($suplemen->gambarSuplemen) > 0)
                            <div class="flex transition-transform duration-500" 
                                 :style="{ transform: `translateX(-${activeIndex * 100}%)` }">
                                @foreach ($suplemen->gambarSuplemen as $gambar)
                                <img src="{{ asset('storage/' . $gambar->path) }}" 
                                     class="w-full h-96 object-cover flex-shrink-0"
                                     alt="{{ $gambar->img_alt ?? $suplemen->nama_suplemen }}" />
                                @endforeach
                            </div>
                            @if(count($suplemen->gambarSuplemen) > 1)
                                <button @click="activeIndex = activeIndex > 0 ? activeIndex - 1 : {{ count($suplemen->gambarSuplemen) - 1 }}"
                                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white p-2 rounded-full transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                                </button>
                                <button @click="activeIndex = activeIndex < {{ count($suplemen->gambarSuplemen) - 1 }} ? activeIndex + 1 : 0"
                                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white p-2 rounded-full transition">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </button>
                            @endif
                        @else
                            <div class="w-full h-96 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                        <div class="flex items-center gap-2 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" />
                            </svg>
                            <h3 class="font-bold text-white text-lg">{{ __('Description') }}</h3>
                        </div>
                        <p class="text-gray-300 leading-relaxed">{{ $suplemen->deskripsi_suplemen ?? __('No description available.') }}</p>
                    </div>

                    @if($suplemen->tanggal_kadaluarsa)
                        <div class="bg-yellow-900/20 border border-yellow-500/40 rounded-lg p-4 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="text-yellow-200 font-semibold text-sm">{{ __('Expiration Date') }}</p>
                                <p class="text-yellow-300 text-sm">{{ \Carbon\Carbon::parse($suplemen->tanggal_kadaluarsa)->format('d F Y') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right: Price and Add to Cart -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-gradient-to-br from-red-900/30 to-red-900/10 border border-red-500/30 p-6 rounded-xl space-y-6 sticky top-4">
                        <!-- Price Section -->
                        <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                            <p class="text-gray-400 text-sm uppercase tracking-wide font-semibold mb-1">{{ __('Price') }}</p>
                            <h2 class="text-4xl font-bold text-red-500 mb-3">Rp {{ number_format($suplemen->harga, 0, ',', '.') }}</h2>
                            
                            @if($suplemen->stok > 0)
                                <div class="flex items-center gap-2 text-green-400 text-sm font-semibold">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    {{ __('In Stock') }} ({{ $suplemen->stok }})
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-red-400 text-sm font-semibold">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                                    {{ __('Out of Stock') }}
                                </div>
                            @endif
                        </div>

                        <!-- Action Section -->
                        @auth
                            @if($suplemen->stok > 0)
                                <form action="{{ route('suplemen.addToCart') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="id_suplemen" value="{{ $suplemen->id }}">
                                    <input type="hidden" name="harga_produk" value="{{ $suplemen->harga }}">
                                    
                                    <div>
                                        <label class="block text-sm font-bold text-gray-300 mb-2 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                            </svg>
                                            {{ __('Quantity') }}
                                        </label>
                                        <input type="number" 
                                               name="jumlah_produk" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $suplemen->stok }}"
                                               required
                                               class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white border-2 border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition">
                                    </div>
                                    
                                    <button type="submit"
                                        class="w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-center py-3 rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                        </svg>
                                        {{ __('Add to Cart') }}
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-700 text-gray-400 text-center py-3 rounded-lg font-bold cursor-not-allowed opacity-60">
                                    {{ __('Out of Stock') }}
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white text-center py-3 rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                </svg>
                                {{ __('Login to Buy') }}
                            </a>
                        @endauth

                        <!-- Features -->
                        <div class="border-t border-gray-700 pt-4 space-y-3 text-sm">
                            <div class="flex items-center gap-2 text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Fast Delivery') }}
                            </div>
                            <div class="flex items-center gap-2 text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('Original Product Guaranteed') }}
                            </div>
                            <div class="flex items-center gap-2 text-green-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ __('24/7 Customer Support') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
                <!-- Left: Image Carousel and Info -->
                <div class="w-full lg:w-2/3 space-y-6">
                    <div class="relative overflow-hidden rounded-xl bg-gray-900" x-data="{ activeIndex: 0 }">
                        @if(isset($suplemen->gambarSuplemen) && count($suplemen->gambarSuplemen) > 0)
                            <div class="flex transition-transform duration-500" 
                                 :style="{ transform: `translateX(-${activeIndex * 100}%)` }">
                                @foreach ($suplemen->gambarSuplemen as $gambar)
                                <img src="{{ asset('storage/' . $gambar->path) }}" 
                                     class="w-full h-96 object-cover flex-shrink-0"
                                     alt="{{ $gambar->img_alt ?? $suplemen->nama_suplemen }}" />
                                @endforeach
                            </div>
                            @if(count($suplemen->gambarSuplemen) > 1)
                                <button @click="activeIndex = activeIndex > 0 ? activeIndex - 1 : {{ count($suplemen->gambarSuplemen) - 1 }}"
                                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90 transition">
                                    ‹
                                </button>
                                <button @click="activeIndex = activeIndex < {{ count($suplemen->gambarSuplemen) - 1 }} ? activeIndex + 1 : 0"
                                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-full hover:bg-opacity-90 transition">
                                    ›
                                </button>
                            @endif
                        @else
                            <div class="w-full h-96 bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $suplemen->nama_suplemen }}</h1>
                        <div class="mt-4 text-gray-300">
                            <h3 class="font-semibold mb-2 text-white">Deskripsi</h3>
                            <p class="text-sm leading-relaxed">{{ $suplemen->deskripsi_suplemen ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                        
                        @if($suplemen->tanggal_kadaluarsa)
                            <div class="mt-4">
                                <h3 class="font-semibold mb-2 text-white">Tanggal Kadaluarsa</h3>
                                <p class="text-sm text-gray-300">
                                    {{ \Carbon\Carbon::parse($suplemen->tanggal_kadaluarsa)->format('d F Y') }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Price and Add to Cart -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-gray-700 p-6 rounded-xl border border-gray-600 space-y-6 sticky top-4">
                        <div>
                            <p class="text-gray-400 text-sm mb-2">Harga</p>
                            <h2 class="text-3xl font-bold text-white">Rp {{ number_format($suplemen->harga, 0, ',', '.') }}</h2>
                            @if($suplemen->stok > 0)
                                <p class="text-green-400 text-sm mt-2">✓ Stok Tersedia ({{ $suplemen->stok }})</p>
                            @else
                                <p class="text-red-400 text-sm mt-2">✗ Stok Habis</p>
                            @endif
                        </div>

                        @auth
                            @if($suplemen->stok > 0)
                                <form action="{{ route('suplemen.addToCart') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="id_suplemen" value="{{ $suplemen->id }}">
                                    <input type="hidden" name="harga_produk" value="{{ $suplemen->harga }}">
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah</label>
                                        <input type="number" 
                                               name="jumlah_produk" 
                                               value="1" 
                                               min="1" 
                                               max="{{ $suplemen->stok }}"
                                               required
                                               class="w-full px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600">
                                    </div>
                                    
                                    <button type="submit"
                                        class="w-full bg-red-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                                        Tambah ke Keranjang
                                    </button>
                                </form>
                            @else
                                <button disabled
                                    class="w-full bg-gray-600 text-gray-400 text-center py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Stok Habis
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="block w-full bg-red-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                                Login untuk Membeli
                            </a>
                        @endauth

                        <div class="border-t border-gray-600 pt-4 text-sm text-gray-400 space-y-2">
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Pengiriman cepat
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Garansi produk asli
                            </p>
                            <p class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Support 24/7
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />

