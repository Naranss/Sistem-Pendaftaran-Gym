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
<<<<<<< HEAD
    // Otomatisasi Menambahkan kontak ketika kontrak terbuat
    static::created(function ($kontrak) {
        ChatRoom::firstOrCreate([
            'trainer_id' => $kontrak->id_trainer,
            'member_id' => $kontrak->id_client,
        ]);
    });
=======
        // Otomatisasi Menambahkan chat room hanya ketika kontrak sudah dibayar (status=active)
        static::updated(function ($kontrak) {
            if ($kontrak->status === 'active' && $kontrak->wasChanged('status')) {
                \App\Models\ChatRoom::firstOrCreate([
                    'trainer_id' => $kontrak->id_trainer,
                    'member_id' => $kontrak->id_client,
                ]);
            }
        });
>>>>>>> cc2d019606d1050d7861c7be7080f0d40cddc1c9
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
