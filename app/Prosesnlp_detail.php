<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prosesnlp_detail extends Model
{
    public $incrementing = false;
    protected $keyType = "string";
    protected $table = 'prosesnlp_detail';
    protected $fillable = ['kata', 'token', 'prosesnlp_id'];
}
