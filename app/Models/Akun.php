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
     * Update the model in the database.
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
    public function update(array $attributes = [], array $options = [])
    {
        return parent::update($attributes, $options);
    }

    /**
     * Get the user's profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path) {
            return asset($this->profile_photo_path);
        }

        return asset('assets/profilPhoto/default.png');
    }
}
