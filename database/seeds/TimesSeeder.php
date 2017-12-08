<?php
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;


class TimesSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('times')->insert([
            'nome' => 'Atletico-GO',
            'estadio_id' => 1,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/atleticogoianiense.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('times')->insert([
            'nome' => 'Atletico Mineiro',
            'estadio_id' => 2,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/atleticomineiro.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('times')->insert([
            'nome' => 'Atletico Paranaense',
            'estadio_id' => 3,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/atleticoparanaense.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Avai',
            'estadio_id' => 4,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/avai.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Bahia',
            'estadio_id' => 5,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/bahia.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Botafogo',
            'estadio_id' => 6,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/botafogo.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Chapecoense',
            'estadio_id' => 7,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/chapecoense.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Corinthians',
            'estadio_id' => 8,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/corinthians.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Coritiba',
            'estadio_id' => 9,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/coritiba.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Cruzeiro',
            'estadio_id' => 10,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/cruzeiro.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Flamengo',
            'estadio_id' => 11,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/flamengo.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Fluminense',
            'estadio_id' => 12,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/fluminense.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Gremio',
            'estadio_id' => 13,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/gremio.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Palmeiras',
            'estadio_id' => 14,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/palmeiras.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Ponte Preta',
            'estadio_id' => 15,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/pontepreta.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Santos',
            'estadio_id' => 16,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/santos.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'São Paulo',
            'estadio_id' => 17,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/saopaulo.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Sport',
            'estadio_id' => 18,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/sport.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Vasco',
            'estadio_id' => 19,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/vasco.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('times')->insert([
            'nome' => 'Vitória',
            'estadio_id' => 20,
            'campeonato_id' => 1,
            'numero_torcedores' => rand(500, 80000),
            'caixa' => 200000,
            'escudo'=> 'img/vitoria.png',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}