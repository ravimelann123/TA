<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetail';
    protected $fillable = ['order_id', 'produk_id', 'jumlah'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
