<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classificacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campeonato_id');
            $table->integer('time_id');
            $table->integer('vitorias')->default(0);
            $table->integer('empates')->default(0);
            $table->integer('derrotas')->default(0);
            $table->integer('pontuacao')->default(0);

            $table->index('campeonato_id');
            $table->index('time_id');


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
        Schema::table('classificacao', function (Blueprint $table) {
            //
        });
    }
}
