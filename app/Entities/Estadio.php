<?php


namespace App\Entities;


class Estadio
{
    protected $table = "estadios";

    protected $fillable = [
        'nome',
        'time_id',
        'capacidade',
        'valor_ingresso',
    ];

    public function time(){
        return $this->hasOne(Time::class, "time_id");
    }

}