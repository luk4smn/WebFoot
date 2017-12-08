<?php

namespace App\Entities;


class Time extends Entity
{
    protected $table = "times";

    protected $fillable = [
        'nome',
        'user_id' ,
        'estadio_id',
        'campeonato_id',
        'numero_torcedores',
        'caixa'
    ];

    public function jogadores(){
        return $this->hasMany(Jogador::class, "time_id");
    }

    public function campeonato(){
        return $this->hasOne(Campeonato::class, "campeonato_id");
    }

    public function estadio(){
        return $this->hasOne(Estadio::class, "estadio_id");
    }
}