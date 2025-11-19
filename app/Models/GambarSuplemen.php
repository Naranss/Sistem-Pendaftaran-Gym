<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GambarSuplemen extends Model
{
    //
    protected $table = 'gambar_suplemen';
    protected $guarded = ['id'];

    public function suplemen()
    {
        return $this->belongsTo(Suplemen::class, 'suplemen_id');
    }
}
