<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengambil extends Model
{
    use HasFactory;
    protected $fillable = ['nama','id_user','jabatan'];
    protected $guard = [];


    /**
     * Get all of the keluar for the Pengambil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keluar()
    {
        return $this->hasMany(Keluar::class, 'id_pengambil', 'id');
    }
}
