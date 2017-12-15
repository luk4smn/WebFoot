<?php


namespace App\Entities;


class Estadio extends Entity
{
    protected $table = "estadios";

    protected $fillable = [
        'nome',
        'time_id',
        'capacidade',
        'valor_ingresso',
    ];

}