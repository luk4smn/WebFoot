<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campeonato_id');
            $table->integer('time_mandante_id');
            $table->integer('time_visitante_id');
            $table->integer('placar_mandante')->nullable();
            $table->integer('placar_visitante')->nullable();

            $table->index('campeonato_id');
            $table->index('time_mandante_id');
            $table->index('time_visitante_id');

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
        Schema::table('partidas', function (Blueprint $table) {
            //
        });
    }
}
