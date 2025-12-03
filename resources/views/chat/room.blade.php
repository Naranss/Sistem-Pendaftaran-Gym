{{-- filepath: resources/views/chat/room.blade.php --}}
<x-layout title="Chat Room">
    <div class="w-full h-screen bg-gray-900 py-4 px-4">
        <div class="w-full h-full max-w-6xl mx-auto flex flex-col">
            <div class="mb-4 flex items-center justify-between gap-4 flex-none">
                <div>
                    <h1 class="text-2xl font-semibold text-white">Chat</h1>
                    <p class="text-sm text-gray-400">Manage your profile and account settings</p>
                </div>
                <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium border border-gray-500 text-gray-100 rounded-lg hover:bg-gray-800 hover:border-gray-300 transition">
                    Kembali ke Homepage
                </a>
            </div>

            <div class="bg-gray-900 border border-gray-700 rounded-none shadow-lg p-0 flex-1 min-h-0">
                <div class="bg-white overflow-hidden h-full">
                    <div class="flex h-full">
                        {{-- Sidebar kiri --}}
                        <div class="w-1/3 border-r border-gray-200 bg-gray-50 flex flex-col">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Contacts</p>
                            </div>

                            <div class="flex-1 overflow-y-auto">
                                @foreach($rooms as $r)
                                    @php
                                        $isActive = $r->id === $room->id;
                                        $contact = Auth::user()->role == 'TRAINER' ? $r->member : $r->trainer;
                                    @endphp
                                    <a href="{{ route('chat.room.show', $r->id) }}"
                                       class="block px-4 py-3 text-sm flex flex-col gap-0.5 border-l-4 {{ $isActive ? 'bg-yellow-50 border-yellow-500' : 'border-transparent hover:bg-yellow-50' }}">
                                        <span class="font-medium text-gray-800 truncate">{{ $contact->nama }}</span>
                                        <span class="text-xs text-gray-500 truncate">{{ $contact->email ?? '-' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Area chat kanan --}}
                        <div class="flex-1 flex flex-col bg-gray-50 min-h-0">
                            <div class="flex items-center justify-between px-6 py-3 border-b border-gray-200 text-sm text-gray-600">
                                <div>
                                    @if(Auth::user()->role == 'TRAINER')
                                        {{ $room->member->nama }}
                                    @else
                                        {{ $room->trainer->nama }}
                                    @endif
                                </div>
                                <div class="text-xs text-gray-400">
                                    @if(Auth::user()->role == 'TRAINER')
                                        {{ $room->member->email ?? '' }}
                                    @else
                                        {{ $room->trainer->email ?? '' }}
                                    @endif
                                </div>
                            </div>

                            <div class="flex-1 flex flex-col min-h-0">
                                <div id="messages" class="flex-1 px-6 py-4 overflow-y-auto flex flex-col gap-2 bg-gray-50">
                                    @foreach($room->messages as $msg)
                                        @if($msg->sender_id == auth()->id())
                                            <div class="flex justify-end">
                                                <div class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg max-w-xs shadow">
                                                    <div class="font-semibold text-sm">{{ $msg->sender->nama }}</div>
                                                    <div class="text-base">{{ $msg->message }}</div>
                                                    <div class="text-xs text-gray-700 mt-1">{{ $msg->created_at->format('H:i d-m-Y') }}</div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="flex justify-start">
                                                <div class="bg-gray-700 text-white px-4 py-2 rounded-lg max-w-xs shadow">
                                                    <div class="font-semibold text-sm text-yellow-400">{{ $msg->sender->nama }}</div>
                                                    <div class="text-base">{{ $msg->message }}</div>
                                                    <div class="text-xs text-gray-400 mt-1">{{ $msg->created_at->format('H:i d-m-Y') }}</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="border-t border-gray-200 bg-white px-4 py-3">
                                    <form id="chat-form" class="flex items-center gap-3">
                                        @csrf
                                        <input type="text" id="message-input" name="message" placeholder="Type your message..." required
                                               class="flex-1 px-4 py-2 rounded-full border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <button type="submit" id="send-btn"
                                                class="px-5 py-2 rounded-full bg-yellow-600 text-white text-sm font-medium hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                            Send
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const roomId = "{{ $room->id }}";
        const userId = "{{ auth()->id() }}";
        
        // Handle form submission
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });
        
        function appendMessage({ isOwn, senderName, message, time }) {
            const container = document.getElementById('messages');
            const side = isOwn ? 'end' : 'start';
            const bgColor = isOwn ? 'bg-yellow-400 text-gray-900' : 'bg-gray-700 text-white';
            const nameColor = isOwn ? '' : 'text-yellow-400';
            const timeColor = isOwn ? 'text-gray-700' : 'text-gray-400';

            const html = `<div class="flex justify-${side}">
                <div class="${bgColor} px-4 py-2 rounded-lg max-w-xs shadow">
                    <div class="font-semibold text-sm ${nameColor}">${senderName}</div>
                    <div class="text-base">${message}</div>
                    <div class="text-xs ${timeColor} mt-1">${time}</div>
                </div>
            </div>`;

            container.insertAdjacentHTML('beforeend', html);
            container.scrollTop = container.scrollHeight;
        }

        function sendMessage() {
            const input = document.getElementById('message-input');
            const message = input.value.trim();
            
            if (!message) return;
            
            const btn = document.getElementById('send-btn');
            btn.disabled = true;
            btn.textContent = 'Mengirim...';
            
            fetch("{{ route('chat.room.send', $room->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            })
            .then(r => r.json())
            .then(data => {
                input.value = '';
                btn.disabled = false;
                btn.textContent = 'Kirim';
                input.focus();

                // Tambahkan pesan milik pengirim langsung (karena broadcast menggunakan toOthers)
                if (data.message) {
                    appendMessage({
                        isOwn: true,
                        senderName: data.message.sender_name ?? '',
                        message: data.message.message ?? '',
                        time: data.message.created_at ?? ''
                    });
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.textContent = 'Kirim';
                alert('Gagal: ' + err.message);
            });
        }
        
        function loadMessages() {
            fetch("{{ route('chat.api.messages', $room->id) }}")
                .then(r => r.json())
                .then(data => {
                    const container = document.getElementById('messages');
                    container.innerHTML = '';
                    
                    data.messages.forEach(msg => {
                        const isOwn = String(msg.sender_id) === String(userId);
                        appendMessage({
                            isOwn,
                            senderName: msg.sender_name,
                            message: msg.message,
                            time: msg.time,
                        });
                    });
                });
        }
        
        // Initial load of messages
        loadMessages();

        // Realtime listener menggunakan Laravel Echo + Reverb
        if (typeof Echo !== 'undefined') {
            Echo.private(`chat.room.${roomId}`)
                .listen('ChatMessageSent', (e) => {
                    // Pesan dari user lain pada room yang sama
                    if (String(e.sender_id) === String(userId)) {
                        return;
                    }

                    appendMessage({
                        isOwn: false,
                        senderName: e.sender_name,
                        message: e.message,
                        time: e.created_at,
                    });
                });
        }
    </script>
</x-layout>
