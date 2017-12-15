<?php


namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagens';

    protected $fillable = [
        'mensagem',
        'user_id'
    ];

}