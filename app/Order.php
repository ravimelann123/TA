<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['nomerpesanan', 'produk_id', 'jumlah', 'status', 'total', 'users_id'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}
