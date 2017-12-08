<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampeonatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campeonato', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->decimal('premio');
            $table->decimal('premio_vitoria');
            $table->decimal('premio_empate');
            $table->integer('num_partidas');

            $table->timestamps();
            $table->softDeletes();

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campeonato', function (Blueprint $table) {
            //
        });
    }
}
