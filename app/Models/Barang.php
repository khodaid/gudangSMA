<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['id','nama','kategori','id_user','id_satuan'];
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

    /**
     * Get all of the inventaris for the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class, 'id_barang', 'id');
    }

    /**
     * Get the user that owns the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
