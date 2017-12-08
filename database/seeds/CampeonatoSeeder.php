<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class CampeonatoSeeder extends Seeder
{
    public function run(){
        $faker = Faker\Factory::create();

        DB::table('campeonato')->insert([
            'nome' => 'Brasileiro',
            'premio' => 100000,
            'premio_vitoria' => 1000,
            'premio_empate' => 500,
            'num_partidas'=> 38,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}