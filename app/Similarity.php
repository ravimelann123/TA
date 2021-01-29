<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Similarity extends Model
{
    protected $table = 'similarity';
    protected $fillable = ['dataset_id', 'similarity', 'prosesnlp_id'];

    // public function users()
    // {
    //     return $this->belongsTo(Users::class);
    // }
    public function dataset()
    {
        return $this->belongsTo(Dataset::class);
    }
    public function prosesnlp()
    {
        return $this->belongsTo(Prosesnlp::class);
    }
}
