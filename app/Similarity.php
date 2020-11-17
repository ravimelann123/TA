<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Similarity extends Model
{

    protected $table = 'similaritytable';
    protected $fillable = ['pesan', 'users_id', 'balas', 'similarity'];
}
