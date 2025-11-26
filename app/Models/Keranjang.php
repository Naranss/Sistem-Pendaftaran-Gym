<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'id_suplemen',
        'membership',
        'harga_membership',
        'jumlah_produk',
    ];

    # relasi ke tabel akun (user)
    public function user()
    {
        return $this->belongsTo(Akun::class, 'user_id');
    }

    # relasi ke tabel suplemen
    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class, 'id_suplemen');
    }
}
