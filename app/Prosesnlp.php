<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prosesnlp extends Model
{
    protected $table = 'prosesnlp';
    protected $fillable = ['kalimat_id', 'parsing'];

    public function kalimat()
    {
        return $this->belongsTo(Kalimat::class);
    }
    public function similarity()
    {
        return $this->hasMany(Similarity::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'prosesnlp_id', 'id');
    }
}
