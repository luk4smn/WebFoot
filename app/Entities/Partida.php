<?php


namespace App\Entities;


class Partida extends Entity
{
    protected $table = "partidas";

    protected $fillable = [
        'campeonato_id',
        'time_mandante_id',
        'time_visitante_id' ,
        'placar',
        'premio_empate',
        'num_partidas'
    ];

    public function campeonato(){
        return $this->hasOne(Campeonato::class, "campeonato_id");
    }
}