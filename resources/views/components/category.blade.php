<a href="{{ $route }}" class="w-48 p-4 bg-white rounded-lg shadow-md flex flex-col items-center justify-center text-black hover:bg-gray-200 transition-all duration-200 ease-in-out transform hover:-translate-y-1">
    
    {{-- Cek apakah slot 'icon' diisi --}}
    @if (isset($icon))
        <div class="text-gray-800">
            {{-- Render konten dari slot 'icon' --}}
            {{ $icon }}
        </div>
    @endif

    {{-- Tampilkan label dari properti class --}}
    <span class="font-semibold text-center mt-2">{{ $label }}</span>
</a>
