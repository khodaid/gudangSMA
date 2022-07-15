<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $fillable = ['nama','id_user','deskirpsi'];
    protected $guard = [];

    /**
     * The inventaris that belong to the Dana
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function inventaris()
    {
        return $this->belongsToMany(Inventaris::class, 'inventaris_dana', 'id_lokasi', 'id_inventaris');
    }
}
