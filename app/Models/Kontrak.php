<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Kontrak extends Model
{
    use HasFactory;

    protected $fillable = [
        "idKontrak",
        "idTrainer",
        "idClient",
        "durasiKontrak"
    ];
    protected $casts = [
        "idKontrak" => "integer",
        "idTrainer" => "integer",
        "idClient" => "integer",
        "durasiKontrak" => "datetime"
    ];
    protected static function booted()
    {
        if (Auth::check() &&  Auth::user()->role == 'TRAINER'){
            static::addGlobalScope('trainer', function ($builder) {
                $builder->where('idTrainer', Auth::user()->idUser);
            });
        }
        if (Auth::check() &&  Auth::user()->role == 'PENGUNJUNG'){
            static::addGlobalScope('client', function ($builder) {
                $builder->where('idClient', Auth::user()->idUser);
            });
        }
    }


    public function trainer()
    {

        return $this->belongsTo(User::class, 'idTrainer');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'idClient');
    }
}
