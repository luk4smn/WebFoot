<?php

use Illuminate\Database\Seeder;
use App\Entities\Partida;

class RodadasSeeder extends Seeder
{

    public function run(){
        $sorteioDoCampeonato = new Partida();

        $sorteioDoCampeonato->setSorteio();
    }

}