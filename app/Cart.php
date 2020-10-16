<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['jumlah', 'produk_id', 'users_id',];
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}
