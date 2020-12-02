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
}
