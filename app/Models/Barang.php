<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['id','nama'];
    protected $guard = [];
    protected $table = 'barangs';

    /**
     * The satuan that belong to the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class,'id_satuan','id');
    }

    /**
     * Get all of the comments for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masuk()
    {
        return $this->hasMany(Masuk::class,'id_barang','id');
    }

    /**
     * Get all of the keluar for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function keluar()
    {
        return $this->hasMany(Keluar::class, 'id_barang', 'id');
    }
}
