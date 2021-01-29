<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kalimat extends Model
{
    protected $table = 'kalimat';
    protected $fillable = ['users_id', 'kalimat'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function prosesnlp()
    {
        return $this->hasOne(Prosesnlp::class, 'kalimat_id', 'id');
    }
    public function order()
    {
        return $this->hasOneThrough(Order::class, Prosesnlp::class, 'kalimat_id', 'prosesnlp_id', 'id', 'id');
    }
    public function similarity()
    {
        return $this->hasMany(Similarity::class);
    }
}
