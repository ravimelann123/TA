<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kata extends Model
{
    protected $table = 'bahasaalami';
    protected $fillable = ['tag', 'kata'];
}
