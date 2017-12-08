<?php
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class EstadioSeeder extends Seeder
{

    public function run(){
        $faker = Faker\Factory::create();

        for($i=1; $i<=20; $i++)

            DB::table('estadio')->insert([
                'nome' => 'Arena ' . $faker->name,
                'time_id' => $i,
                'capacidade' =>$faker->randomNumber(3),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

}

}