<x-layout title="Beli Suplemen - Member">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-white mb-6">Katalog Suplemen</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Example Product Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('assets/products/whey-protein.jpg') }}" alt="Whey Protein" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">Whey Protein</h3>
                    <p class="text-gray-600 mb-4">100% Pure Whey Protein Isolate</p>
                    <div class="mb-4">
                        <span class="text-lg font-bold text-blue-600">Rp 750.000</span>
                        <span class="text-sm text-gray-500 ml-2">1kg</span>
                    </div>
                    <button class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition-colors">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>

            <!-- Add more product cards here -->
        </div>

        <!-- Shopping Cart Floating Button -->
        <div class="fixed bottom-8 right-8">
            <button class="bg-blue-600 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition-colors">
                🛒 <span class="ml-2">3</span>
            </button>
        </div>
    </div>
</x-layout>