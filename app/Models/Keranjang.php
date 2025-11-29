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
        'id_akun',
        'id_suplemen',
        'membership',
        'harga_membership',
        'jumlah_produk',
    ];

    # relasi ke tabel akun (user)
    public function user()
    {
        return $this->belongsTo(Akun::class, 'id_akun');
    }

    # relasi ke tabel suplemen
    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class, 'id_suplemen');
    }
}
