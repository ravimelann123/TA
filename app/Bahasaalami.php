<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahasaalami extends Model
{
    protected $table = 'bahasaalami';
    protected $fillable = ['kata', 'tag'];
}
