{{-- filepath: resources/views/chat/room.blade.php --}}
<x-layout title="Chat Room">
    <div class="max-w-2xl mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4 text-white">
            Chat dengan 
            @if(Auth::user()->role == 'TRAINER')
                {{ $room->member->nama }} (Member)
            @else
                {{ $room->trainer->nama }} (Trainer)
            @endif
        </h2>
        <div id="messages" class="bg-gray-800 rounded-lg p-4 h-80 overflow-y-auto mb-4 flex flex-col gap-2">
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
        <form id="chat-form" class="flex gap-2">
            @csrf
            <input type="text" id="message-input" name="message" placeholder="Ketik pesan..." required
                   class="flex-1 px-4 py-2 rounded bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-yellow-400">
            <button type="submit" id="send-btn"
                    class="bg-yellow-400 text-gray-900 px-4 py-2 rounded hover:bg-yellow-300 transition font-semibold">
                Kirim
            </button>
        </form>
    </div>

    <script>
        const roomId = "{{ $room->id }}";
        const userId = "{{ auth()->id() }}";
        
        // Handle form submission
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });
        
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
                loadMessages();
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
                        const side = isOwn ? 'end' : 'start';
                        const bgColor = isOwn ? 'bg-yellow-400 text-gray-900' : 'bg-gray-700 text-white';
                        const nameColor = isOwn ? '' : 'text-yellow-400';
                        const timeColor = isOwn ? 'text-gray-700' : 'text-gray-400';
                        
                        const html = `<div class="flex justify-${side}">
                            <div class="${bgColor} px-4 py-2 rounded-lg max-w-xs shadow">
                                <div class="font-semibold text-sm ${nameColor}">${msg.sender_name}</div>
                                <div class="text-base">${msg.message}</div>
                                <div class="text-xs ${timeColor} mt-1">${msg.time}</div>
                            </div>
                        </div>`;
                        
                        container.innerHTML += html;
                    });
                    
                    container.scrollTop = container.scrollHeight;
                });
        }
        
        // Auto-refresh every 2 seconds
        setInterval(loadMessages, 2000);
        loadMessages();
    </script>
</x-layout>
