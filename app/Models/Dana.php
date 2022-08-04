<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    protected $fillable = ['nama','id_user','keterangan'];
    protected $guard = [];

    /**
     * The inventaris that belong to the Dana
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventaris()
    {
        return $this->hasMany(Inventaris::class,'id_dana', 'id');
    }

    /**
     * Get the user that owns the Dana
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
