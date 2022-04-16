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
}
