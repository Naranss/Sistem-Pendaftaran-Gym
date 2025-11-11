<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal',
        'id_produk',
        'id_kontrak',
        'membership',
        'jumlah_produk',
        'harga_produk',
        'harga_kontrak',
        'harga_membership',
        'metode_pembayaran',
        'user_id',
        'status',
    ];

    # relasi ke tabel keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'id_produk');
    }

    #relasi tambah tabel kontrak
    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_kontrak');
    }

    # relasi ke tabel akun (user)
    public function user()
    {
        return $this->belongsTo(Akun::class, 'user_id');
    }
}
