<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    protected $table = 'dataset';
    protected $fillable = ['chat', 'balas'];

    public function similarity()
    {
        return $this->hasMany(Similarity::class);
    }
}
