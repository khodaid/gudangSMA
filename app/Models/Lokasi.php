<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $fillable = ['nama_lokasi','id_user','deskirpsi'];
    protected $guard = [];


    /**
     * Get all of the inventaris for the Lokasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'id_lokasi', 'id');
    }
}
