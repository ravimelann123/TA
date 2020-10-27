<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama', 'deskripsi', 'stok', 'harga'];

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }

    public function tambahstok()
    {
        return $this->hasOne(Tambahstok::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
