# Real-Time Chat dengan Laravel Reverb - Setup & Jalankan

## 📋 Checklist Setup

✅ **Event** (`app/Events/ChatMessageSent.php`)
- Menggunakan `ShouldBroadcastNow` untuk instant broadcasting
- Broadcast ke channel `chat.room.{roomId}`
- Data yang di-broadcast: id, sender_id, sender_name, message, created_at

✅ **Controller** (`app/Http/Controllers/ChatController.php`)
- `index()` - List chat rooms
- `show()` - View chat room dengan history messages
- `send()` - Send message dan broadcast ke orang lain
- `getMessages()` - Get all messages sebagai JSON (fallback polling)

✅ **Routes** (`routes/web.php`)
```
GET  /chat                    → chat.room.index
GET  /chat/{room}             → chat.room.show
POST /chat/{room}/send        → chat.room.send
GET  /chat/{room}/messages    → chat.api.messages (fallback)
POST /broadcasting/auth       → Reverb authentication
```

✅ **Config** 
- `config/broadcasting.php` - Konfigurasi Reverb
- `.env` - Reverb credentials dan environment

✅ **Frontend**
- `resources/js/bootstrap.js` - Echo initialization dengan Reverb
- `resources/views/chat/room.blade.php` - Chat UI dengan Echo listener

---

## 🚀 Cara Menjalankan

### 1. **Start Reverb Server** (Terminal 1)
```bash
cd "d:\Tugas kuliah rill\SEMESTER 5\Proyek Informatika\Sistem-Pendaftaran-Gym"
php artisan reverb:start
```

**Output yang diharapkan:**
```
   INFO  Starting Reverb server...
   INFO  Server running on 0.0.0.0:8080
```

### 2. **Build Frontend Assets** (Terminal 2)
```bash
npm run dev
```

### 3. **Start Laravel Server** (Terminal 3)
```bash
php artisan serve
```

### 4. **Test Chat**
1. Buka `http://localhost:8000` di 2 browser/tab berbeda
2. Login sebagai Trainer di satu tab, Member di tab lain
3. Buka chat room
4. Kirim pesan - akan muncul real-time di tab lain!

---

## 🔄 Cara Kerja

### **Real-Time Flow:**
1. User A ketik pesan & klik "Kirim"
2. AJAX POST ke `/chat/{room}/send`
3. Server menyimpan pesan ke database
4. Server broadcast event `ChatMessageSent` ke channel `chat.room.1`
5. Laravel Echo mendengarkan channel, menerima event
6. JavaScript menambahkan pesan ke UI secara real-time
7. User B melihat pesan langsung (tanpa refresh)

### **Fallback (Jika Reverb down):**
- JavaScript auto-fallback ke polling
- Setiap 1.5 detik fetch `/chat/{room}/messages`
- Update UI dengan pesan baru
- Lebih lambat tapi tetap berfungsi

---

## 🛠️ Troubleshooting

### **Error: "Echo is not defined"**
→ Pastikan `npm run dev` sudah dijalankan dan file asset ter-build

### **Error: "Connection refused"**
→ Pastikan Reverb server sudah jalan: `php artisan reverb:start`

### **Pesan tidak muncul**
→ Check browser console untuk error
→ Coba buka console → ketik `Echo` untuk confirm Echo sudah loaded
→ Lihat network tab untuk check WebSocket connection

### **Reverb crash dengan Exit Code 1**
→ Coba format REVERB_HOST/PORT di `.env`
→ Atau gunakan fallback polling (sudah included)

---

## 📦 Dependencies yang Digunakan

- `laravel/reverb` - WebSocket server
- `laravel-echo` - Frontend listener
- `pusher-js` - WebSocket client

Semua sudah installed via composer.

---

## 💡 Notes

- Chat data tersimpan di database MySQL
- Session driver menggunakan database
- Broadcasting auth via route `/broadcasting/auth`
- Polling fallback otomatis jika Reverb unavailable
- Support unlimited chat rooms dan users

