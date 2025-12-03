<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    //
    protected $table = 'membership_plan';

    protected $fillable = [
        'nama_paket_id',
        'nama_paket_en',
        'deskripsi_id',
        'deskripsi_en',
        'durasi',
        'harga',
    ];

    public function scopeFilter(Builder $query, $name)
    {
        if (!empty($name)) {
            return $query->where('nama_paket_id', 'like', '%' . $name . '%')
                         ->orWhere('nama_paket_en', 'like', '%' . $name . '%');
        }
        return $query;
    }
}
