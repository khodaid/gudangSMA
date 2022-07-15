<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['nama','id_user','deskripsi'];
    protected $guard = [];

    /**
     * Get all of the barang for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_barang', 'id');
    }
}
