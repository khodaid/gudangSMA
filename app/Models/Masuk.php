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
}
