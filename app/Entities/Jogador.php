<?php


namespace App\Entities;


class Jogador extends Entity
{
    protected $fillable = [
        'nome',
        'idade',
        'posicao',
        'time_id',
        'atk_rate',
        'def_rate',
    ];

    const
        GOLEIRO = 1,
        DEFENSOR = 2,
        MEIA = 3,
        ATACANTE = 4;

}