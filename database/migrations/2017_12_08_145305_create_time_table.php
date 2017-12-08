<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('user_id')-> nullable();
            $table->integer('estadio_id');
            $table->integer('campeonato_id');
            $table->integer('numero_torcedores');
            $table->decimal('caixa');
            $table->string('escudo');

            $table->index('user_id');
            $table->index('estadio_id');
            $table->index('campeonato_id');


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
        Schema::table('times', function (Blueprint $table) {
            //
        });
    }
}
