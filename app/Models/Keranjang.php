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
        'id_suplemen',
        'membership',
        'harga_membership',
        'jumlah_produk',
    ];

    # relasi ke tabel suplemen
    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class, 'id_suplemen');
    }
}
