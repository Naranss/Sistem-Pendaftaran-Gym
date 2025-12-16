<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;    

class Kontrak extends Model
{
    use HasFactory;

    protected $table = 'kontrak';

    protected $fillable = [
        "id_trainer",
        "id_client",
        "tanggal_berakhir",
        "status"
    ];

    protected static function booted()
    {
    // Otomatisasi Menambahkan kontak ketika kontrak terbuat
    static::created(function ($kontrak) {
        ChatRoom::firstOrCreate([
            'trainer_id' => $kontrak->id_trainer,
            'member_id' => $kontrak->id_client,
        ]);
    });

    }


    public function trainer()
    {
        return $this->belongsTo(Akun::class, 'id_trainer');
    }

    public function client()
    {
        return $this->belongsTo(Akun::class, 'id_client');
    }
}
