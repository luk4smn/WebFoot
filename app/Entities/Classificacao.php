<?php


namespace App\Entities;


class Classificacao extends Entity
{
    protected $table = "classificacao";

    protected $fillable = [
        'campeonato_id',
        'time_id',
        'vitorias' ,
        'empates',
        'derrotas',
        'pontuacao'
    ];

    public function campeonato(){
        return $this->hasOne(Campeonato::class, "campeonato_id");
    }

    public function time(){
        return $this->hasOne(Time::class, 'id','time_id');
    }

}