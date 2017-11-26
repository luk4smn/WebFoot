<?php

namespace App\Entities;


class Time extends Entity
{
    protected $table = "times";

    protected $fillable = [
      'nome',
      'id_user' ,
      'id_estadio'
    ];


}