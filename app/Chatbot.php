<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table = 'dataset';
    protected $fillable = ['chat', 'balas'];
}
