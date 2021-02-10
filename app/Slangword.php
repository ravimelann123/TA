<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slangword extends Model
{
    protected $table = 'slangword';
    protected $fillable = ['slangword', 'formal'];
}
