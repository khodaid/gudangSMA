<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'id_super'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function satuan()
    {
        return $this->hasMany(Satuan::class);
    }

    /**
     * Get all of the masuk for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masuk()
    {
        return $this->hasMany(Masuk::class);
    }

    /**
     * Get all of the dana for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dana()
    {
        return $this->hasMany(Dana::class, 'id_user', 'id');
    }

    /**
     * Get all of the pengambil for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pengambil()
    {
        return $this->hasMany(Pengambil::class, 'id_user', 'id');
    }
}
