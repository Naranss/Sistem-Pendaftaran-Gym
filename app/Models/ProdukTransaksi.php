<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukTransaksi extends Model
{
    use HasFactory;

    protected $table = 'produk_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'id_kontrak',
        'id_membership',
        'jumlah_produk',
        'harga_produk',
        'harga_kontrak',
        'harga_membership',
    ];

    # Relationship to Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    # Relationship to Suplemen (direct, since id_produk stores suplemen ID)
    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class, 'id_produk');
    }

    # Relationship to Kontrak
    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class, 'id_kontrak');
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'id_membership');
    }
}
