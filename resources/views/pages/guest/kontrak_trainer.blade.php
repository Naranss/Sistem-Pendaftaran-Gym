<x-navbar />

<main class="flex-grow min-h-screen bg-gradient-to-b from-gray-900 to-black py-12">
    <div class="container mx-auto px-6 max-w-2xl">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h1 class="text-4xl font-bold text-white">{{ __('Contract Trainer') }}</h1>
            </div>
            <p class="text-gray-400 text-lg">{{ __('Finalize your trainer contract') }}</p>
        </div>

        <div class="bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl shadow-2xl p-8 border border-gray-700">
            @if($errors->any())
                <div class="bg-red-900/40 border border-red-500/50 text-red-200 px-4 py-4 rounded-lg mb-6 flex gap-3">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <div>
                        <h3 class="font-semibold mb-2">{{ __('Please fix the following errors:') }}</h3>
                        <ul class="text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Trainer Information -->
            <div class="bg-gradient-to-br from-red-900/30 to-red-900/10 border border-red-500/30 rounded-xl p-6 mb-8">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                    </svg>
                    <h2 class="text-2xl font-bold text-white">{{ __('Trainer Information') }}</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-1">{{ __('Name') }}</p>
                        <p class="text-white text-lg font-bold">{{ $trainer->nama }}</p>
                    </div>

                    <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-1">{{ __('Email') }}</p>
                        <p class="text-white text-sm">{{ $trainer->email }}</p>
                    </div>

                    <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-1">{{ __('Phone') }}</p>
                        <p class="text-white text-sm">{{ $trainer->no_telp }}</p>
                    </div>

                    <div class="bg-gray-800/50 rounded-lg p-4 border border-gray-700/50">
                        <p class="text-gray-400 text-xs uppercase tracking-wide font-semibold mb-1">{{ __('Gender') }}</p>
                        <p class="text-white text-sm">{{ $trainer->jenis_kelamin }}</p>
                    </div>
                </div>
            </div>

            <!-- Contract Form -->
            <form action="{{ route('guest.trainer.contract.store', $trainer->id) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="tanggal_berakhir" class="block text-gray-300 font-bold mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2h16V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h12a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Contract End Date') }}
                        <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="tanggal_berakhir" 
                        name="tanggal_berakhir"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        required
                        class="w-full px-4 py-3 rounded-lg bg-gray-700 text-white border-2 border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition @error('tanggal_berakhir') border-red-500 @enderror"
                        value="{{ old('tanggal_berakhir') }}"
                    >
                    @error('tanggal_berakhir')
                        <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 14.586 6.313 10.899a1 1 0 00-1.414 1.414l4.394 4.394a1 1 0 001.414 0l7.794-7.793z" clip-rule="evenodd" /></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Info Alert -->
                <div class="bg-gradient-to-r from-blue-900/40 to-blue-900/20 border border-blue-500/40 rounded-lg p-4 flex gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0zM8 8a1 1 0 000 2h6a1 1 0 000-2H8z" clip-rule="evenodd" /></svg>
                    <p class="text-blue-200 text-sm">
                        {{ __('By confirming this contract, you agree to work with this trainer until the specified end date. This contract is binding.') }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4 pt-4">
                    <a href="{{ route('guest.trainer') }}" class="flex-1 inline-block bg-gradient-to-r from-gray-700 to-gray-800 hover:from-gray-800 hover:to-gray-900 text-white px-6 py-3 rounded-lg font-bold transition duration-300 text-center shadow-md flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        {{ __('Cancel') }}
                    </a>
                    <button 
                        type="submit" 
                        class="flex-1 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-lg font-bold transition duration-300 shadow-md flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        {{ __('Confirm Contract') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<x-footer class="bg-gray-900 border-t border-gray-800" />
