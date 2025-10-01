<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $fillable = [
        "idUser",
        "nama",
        "password",
        "email",
        "no_Telp",
        "jenis_kelamin",
        "role",
        "membership_start",
        "membership_end"
    ];

    protected $casts = [
        "gender" => "enum",
        "role" => "enum",
        "membership_start" => "datetime",
        "membership_end" => "datetime",
        "password" => "hashed"
    ];
}
