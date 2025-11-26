<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    /** @use HasFactory<\Database\Factories\ChatFactory> */
    use HasFactory;

    protected $fillable = ['trainer_id', 'member_id'];

    public function trainer()
    {
        return $this->belongsTo(Akun::class, 'trainer_id');
    }

    public function member()
    {
        return $this->belongsTo(Akun::class, 'member_id');
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
