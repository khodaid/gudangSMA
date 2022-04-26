<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;
    protected $table = 'masuks';
    protected $guard = [];
    protected $fillable = ['id','deskripsi','jumlah',
        'tgl_pemesanan','nama_toko','tgl_penerimaan','harga_satuan','jumlah_harga'];

    /**
     * Get the barang that owns the Masuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

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
     * Get the user that owns the Masuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
