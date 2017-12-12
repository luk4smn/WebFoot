<?php


namespace App\Entities;


class Jogador extends Entity
{
    protected $table = "jogadores";

    protected $fillable = [
        'nome',
        'idade',
        'posicao',
        'time_id',
        'salario',
        'passe',
        'atk_rate',
        'def_rate',
    ];

    const
        GOLEIRO = "GOL",
        DEFENSOR = "DEF",
        MEIA = "MEI",
        ATACANTE = "ATK";

    public function time(){
        return $this->hasOne(Time::class, "time_id");
    }
}