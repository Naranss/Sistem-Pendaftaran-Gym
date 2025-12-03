<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ChatMessage extends Model
{
    protected $fillable = ['chat_room_id', 'sender_id', 'message'];

    public function room()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }

    public function sender()
    {
        return $this->belongsTo(Akun::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(Akun::class, 'receiver_id');
    }
}
