<!-- {{-- filepath: resources/views/chat/index.blade.php --}} -->
<x-layout title="Chat Room">
    <div class="max-w-2xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4 text-white">Daftar Kontak Chat</h2>
        <ul class="bg-gray-800 rounded-lg p-4">
            @forelse($rooms as $room)
                <li class="mb-2 flex justify-between items-center">
                    @if(Auth::user()->role == 'TRAINER')
                        <span class="text-white">Member: {{ $room->member->nama }}</span>
                    @else
                        <span class="text-white">Trainer: {{ $room->trainer->nama }}</span>
                    @endif
                    <a href="{{ route('chat.room.show', $room->id) }}"
                       class="bg-yellow-400 text-gray-900 px-3 py-1 rounded hover:bg-yellow-300 transition">Buka Chat</a>
                </li>
            @empty
                <li class="text-gray-400">Belum ada kontak chat.</li>
            @endforelse
        </ul>
    </div>
</x-layout>