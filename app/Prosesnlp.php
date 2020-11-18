<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prosesnlp extends Model
{
    protected $table = 'prosesnlp';
    protected $fillable = ['users_id', 'proses_id', 'kalimat', 'kata', 'token', 'parsing'];
}
