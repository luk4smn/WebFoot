<?php

namespace App\Entities;


class Campeonato extends Entity
{
    protected $table = "campeonato";

    protected $fillable = [
        'nome',
        'premio' ,
        'premio_vitoria',
        'premio_empate',
        'num_partidas'
    ];

    public function times(){
        return $this->hasMany(Time::class, "campeonato_id");
    }

    public function partidas(){
        return $this->hasMany(Partida::class, "campeonato_id");
    }
}