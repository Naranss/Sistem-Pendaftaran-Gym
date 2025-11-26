<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'akun';
    protected $fillable = [
        "nama",
        "password",
        "email",
        "no_telp",
        "jenis_kelamin",
        "role",
        "membership_start",
        "membership_end",
        "profile_photo_path"
    ];

    protected $casts = [
        "gender" => "enum",
        "membership_start" => "datetime",
        "membership_end" => "datetime",
        "password" => "hashed"
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Get the user's profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path 
            ? asset('storage/' . $this->profile_photo_path)
            : asset('assets/images/default.png');
    }
}
