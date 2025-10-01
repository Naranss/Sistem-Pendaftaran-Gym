<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplemen extends Model
{
    use HasFactory;

    protected $fillable = [
        "suplemen_id",
        "nama_suplemen",
        "deskripsi_suplemen",
        "tanggal_kadaluarsa",
        "harga",
        "stok"
    ];

    protected $casts = [
        "expired" => "datetime",
        "harga" => "integer",
        "stok" => "integer"
    ];

    public function scopeFilter(Builder $query, $name)
    {
        if (!empty($name)) {
            return $query->where('nama_suplemen', 'like', '%' . $name . '%');
        }
        return $query;
    }
}
