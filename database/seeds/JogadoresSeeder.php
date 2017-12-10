<?php
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class JogadoresSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $genero = 'male';
        $posicoes = ['ATK', 'MEI', 'DEF', 'GOL'];

        for ($i=0; $i<=1000; $i++){
            $posicao_random = array_rand($posicoes, 1);

            DB::table('jogadores')->insert([
                'nome' => $faker->name($genero),
                'idade' => rand(17, 35),
                'posicao' => $posicoes[$posicao_random],
                'salario' => rand(3000, 15000),
                'passe' => rand(1000, 50000),
                'atk_rate' => rand(60, 99),
                'def_rate' => rand(58, 98),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ]);
        }



    }


}