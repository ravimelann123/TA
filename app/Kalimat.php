<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kalimat extends Model
{
    protected $table = 'kalimat';
    protected $fillable = ['kalimat', 'parsing'];
}
