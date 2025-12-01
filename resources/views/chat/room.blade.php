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
                    <div class="flex justify-end" data-msg-id="{{ $msg->id }}">
                        <div class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg max-w-xs shadow">
                            <div class="font-semibold text-sm">{{ $msg->sender->nama }}</div>
                            <div class="text-base">{{ $msg->message }}</div>
                            <div class="text-xs text-gray-700 mt-1">{{ $msg->created_at->format('H:i d-m-Y') }}</div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start" data-msg-id="{{ $msg->id }}">
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

    @vite('resources/js/app.js')
    <script>
        const roomId = "{{ $room->id }}";
        const userId = "{{ auth()->id() }}";
        const messagesContainer = document.getElementById('messages');
        
        console.log('=== CHAT DEBUG ===');
        console.log('Room ID:', roomId);
        console.log('User ID:', userId);
        console.log('Echo available:', typeof Echo !== 'undefined');
        
        // Collect existing message IDs
        let displayedMessageIds = new Set();
        document.querySelectorAll('#messages [data-msg-id]').forEach(el => {
            displayedMessageIds.add(String(el.dataset.msgId));
        });
        console.log('Initial messages:', displayedMessageIds);

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
            
            console.log('Sending message:', message);
            
            fetch("{{ route('chat.room.send', $room->id) }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            })
            .then(r => {
                console.log('Response status:', r.status);
                if (!r.ok) throw new Error('HTTP ' + r.status);
                return r.json();
            })
            .then(data => {
                console.log('Server response:', data);
                // Tambahkan pesan yang baru saja dikirim ke UI
                if (data.message) {
                    addMessageToUI(data.message, true);
                }
                input.value = '';
                btn.disabled = false;
                btn.textContent = 'Kirim';
                input.focus();
            })
            .catch(err => {
                console.error('Send error:', err);
                btn.disabled = false;
                btn.textContent = 'Kirim';
                alert('Gagal: ' + err.message);
            });
        }

        // Add message bubble to UI
        function addMessageToUI(msg, isOwnMessage = false) {
            const msgId = String(msg.id);
            
            console.log('Adding message:', msgId, 'isOwn:', isOwnMessage);
            
            // Skip jika sudah ditampilkan
            if (displayedMessageIds.has(msgId)) {
                console.log('Message already displayed, skipping');
                return;
            }
            
            displayedMessageIds.add(msgId);
            
            const align = isOwnMessage ? 'end' : 'start';
            const bgColor = isOwnMessage ? 'bg-yellow-400 text-gray-900' : 'bg-gray-700 text-white';
            const nameColor = isOwnMessage ? '' : 'text-yellow-400';
            const timeColor = isOwnMessage ? 'text-gray-700' : 'text-gray-400';
            
            const html = `<div class="flex justify-${align}" data-msg-id="${msgId}">
                <div class="${bgColor} px-4 py-2 rounded-lg max-w-xs shadow">
                    <div class="font-semibold text-sm ${nameColor}">${msg.sender_name}</div>
                    <div class="text-base">${msg.message}</div>
                    <div class="text-xs ${timeColor} mt-1">${msg.created_at}</div>
                </div>
            </div>`;
            
            messagesContainer.insertAdjacentHTML('beforeend', html);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Setup Laravel Echo untuk real-time dengan Reverb
        function setupRealTimeChat() {
            // Check jika Echo tersedia
            if (typeof Echo === 'undefined') {
                console.error('❌ Echo library tidak tersedia - broadcasting tidak aktif');
                console.log('Cek: Apakah Reverb server berjalan?');
                console.log('Cek: Apakah npm run build sudah dijalankan?');
                return;
            }

            console.log('✅ Echo library tersedia');
            
            const channelName = 'chat.room.' + roomId;
            console.log('Subscribing to channel:', channelName);
            
            // Subscribe ke channel
            Echo.private(channelName)
                .listen('ChatMessageSent', (event) => {
                    console.log('✅ Message received from Reverb:', event);
                    
                    // Jangan tampilkan pesan kita sendiri (server sudah menambahkan)
                    if (String(event.sender_id) !== String(userId)) {
                        console.log('Adding received message to UI');
                        addMessageToUI(event, false);
                    } else {
                        console.log('Skipping own message (already added)');
                    }
                })
                .error((error) => {
                    console.error('❌ Channel subscription error:', error);
                });

            // Test: log channel subscription
            console.log('Channel subscription setup complete');
        }

        // Wait untuk Echo siap
        function initializeChat() {
            if (typeof Echo === 'undefined') {
                console.log('Waiting for Echo...');
                setTimeout(initializeChat, 500);
                return;
            }
            setupRealTimeChat();
        }

        // Initialize chat
        console.log('Initializing chat...');
        initializeChat();
        
        // Auto-scroll ke bawah saat page load
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
    </script>
</x-layout>
