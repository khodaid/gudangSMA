<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = ['tgl_pembukuan','kode', 'id_barang','deskripsi','id_satuan','thn_pembuatan','id_dana', 'id_user','tgl_penyerahan',
    'kondisi','harga','file','id_lokasi'];
    protected $guard = [];

    /**
     * Get the satuan that owns the Masuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id');
    }

    /**
     * Get the barang that owns the Inventaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    /**
     * Get the dana that owns the Masuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dana()
    {
        return $this->belongsTo(Dana::class, 'id_dana', 'id');
    }

    /**
     * Get the user that owns the Masuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /**
     * The lokasi that belong to the Inventaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class,'id_lokasi', 'id');
    }

}
