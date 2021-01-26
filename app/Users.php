<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{

    use Notifiable;
    protected $table = 'users';
    protected $fillable = ['username', 'password', 'role', 'nama', 'email', 'nohp', 'alamat', 'avatar'];


    public function tambahstok()
    {
        return $this->hasOne(Tambahstok::class);
    }

    public function cart()
    {
        return $this->hasOne(cart::class);
    }

    public function kalimat()
    {
        return $this->hasOne(Kalimat::class);
    }
    public function similarity()
    {
        return $this->hasOne(Similarity::class);
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('images/default.jpg');
        }
        return asset('images/' . $this->avatar);
    }
}
