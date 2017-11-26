<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 26/11/17
 * Time: 00:45
 */

namespace App\Entities;


class Estadio
{
    protected $fillable = [
        'nome',
        'time_id',
        'capacidade',
        'valor_ingresso',
    ];
}