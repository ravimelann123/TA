<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['nomerpesanan', 'produk_id', 'jumlah', 'users_id', 'status', 'total'];
}
