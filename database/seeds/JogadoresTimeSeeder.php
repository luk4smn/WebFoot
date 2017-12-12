<?php

use Illuminate\Database\Seeder;
use \App\Entities\Jogador;
use \App\Entities\Time;


class JogadoresTimeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $genero = 'male';
        $posicoes = ['ATK', 'MEI', 'DEF', 'GOL'];

        $goleiros = Jogador::where('posicao', Jogador::GOLEIRO)->get();
        $defensores = Jogador::where('posicao', Jogador::DEFENSOR)->get();
        $meias = Jogador::where('posicao', Jogador::MEIA)->get();
        $atacantes = Jogador::where('posicao', Jogador::ATACANTE)->get();

        $times = Time::get();

        foreach ($times as $chave => $time){
            for ($i=0; $i < 4 ; $i++){
                $key = rand(1,200);
                $defensores[$key]->time_id = $time->id;

                $defensores[$key]->save();
            }

            for ($i=0; $i < 4 ; $i++){
                $key = rand(1,200);
                $goleiros[$key]->time_id = $time->id;

                $goleiros[$key]->save();
            }

            for ($i=0; $i < 4 ; $i++){
                $key = rand(1,200);
                $meias[$key]->time_id = $time->id;

                $meias[$key]->save();
            }

            for ($i=0; $i < 4 ; $i++){
                $key = rand(1,200);
                $atacantes[$key]->time_id = $time->id;

                $atacantes[$key]->save();
            }

        }


    }
}