<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kalimat extends Model
{
    protected $table = 'kalimat';
    protected $fillable = ['users_id', 'kalimat', 'parsing'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function prosesnlp()
    {
        return $this->hasMany(Prosesnlp::class);
    }

    public function similarity()
    {
        return $this->hasMany(Similarity::class);
    }
}
