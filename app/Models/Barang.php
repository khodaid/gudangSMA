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
        return $this->belongsToMany(Role::class);
    }
}
