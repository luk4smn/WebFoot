<?php
/**
 * Created by PhpStorm.
 * User: lucas
 * Date: 17/11/17
 * Time: 00:31
 */

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