<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $fillable = ['tgl_pembukuan','kode', 'id_barang','deskrisi',
    'jumlah','id_satuan','thn_pembuatan','id_dana', 'id_user','tgl_penyerahan',
    'kondisi','harga','hrg_total','file'];
    protected $guard = [];

    /**
     * The dana that belong to the Inventaris
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dana()
    {
        return $this->belongsToMany(Dana::class, 'inventaris_dana', 'id_inventaris', 'id_dana');
    }
}
