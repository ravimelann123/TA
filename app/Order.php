<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = ['produk_id', 'jumlah', 'status', 'total'];
    public $incrementing = false;
    protected $keyType = "string";

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function prosesnlp()
    {
        return $this->belongsTo(Prosesnlp::class, 'prosesnlp_id', 'id');
    }
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
