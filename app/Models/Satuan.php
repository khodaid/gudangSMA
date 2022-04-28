<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $fillable = ['id','nama'];
    protected $guard = [];
    protected $table = 'satuans';

    /**
     * Get the user that owns the Satuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id_user','id');
    }

    /**
     * Get all of the barangs for the Satuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barang()
    {
        return $this->hasMany(Barang::class,'id_barang','id');
    }

    /**
     * Get all of the masuk for the Satuan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function masuk()
    {
        return $this->hasMany(Masuk::class,'id_satuan','id');
    }
}
