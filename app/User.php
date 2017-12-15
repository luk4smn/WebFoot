<?php

namespace App;

use App\Entities\Mensagem;
use App\Entities\Time;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'time_id',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function time(){
        return $this->hasOne(Time::class, 'id','time_id');
    }

    public function mensagens(){
        return $this->hasMany(Mensagem::class, 'user_id','id');
    }
}
