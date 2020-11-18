<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    protected $table = 'chatbot';
    protected $fillable = ['chat', 'balas'];
}
