<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    use HasFactory;

    protected $table = 'keluars';
    protected $guard = [];
    protected $fillable = ['id','deskripsi','tgl_keluar','jumlah'];
    protected $casts = [
        'jumlah' => 'integer'
    ];

    /**
     * Get the barang that owns the Keluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    /**
     * Get the satuan that owns the Keluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id');
    }

    /**
     * Get the pengambil that owns the Keluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pengambil()
    {
        return $this->belongsTo(Pengambil::class, 'id_pemngambil', 'id');
    }
}
