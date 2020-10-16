<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tambahstok extends Model
{
    protected $table = 'tambahstok';
    protected $fillable = ['produk_id', 'stok', 'users_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}
