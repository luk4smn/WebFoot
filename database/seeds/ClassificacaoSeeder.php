<?php
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ClassificacaoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();


        for($i=1; $i<=20; $i++)

            DB::table('classificacao')->insert([
                'campeonato_id' => '1',
                'time_id' => $i,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
    }

}