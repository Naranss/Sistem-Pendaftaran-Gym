<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplemen extends Model
{
    use HasFactory;

    /**
     * Table name explicitly set to match migration (migration creates `suplemen`).
     */
    protected $table = 'suplemen';

    protected $fillable = [
        'nama_suplemen',
        'deskripsi_suplemen',
        'tanggal_kadaluarsa',
        'harga',
        'stok',
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'datetime',
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    public function scopeFilter(Builder $query, $name)
    {
        if (!empty($name)) {
            return $query->where('nama_suplemen', 'like', '%' . $name . '%');
        }
        return $query;
    }
}
