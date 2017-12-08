<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(CampeonatoSeeder::class);
        $this->call(ClassificacaoSeeder::class);

    }
}
