<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';
    protected $fillable = ['namafoto,produk_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
