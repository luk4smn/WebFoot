<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('idade');
            $table->string('posicao');
            $table->integer('time_id')->nullable();
            $table->decimal('salario');
            $table->decimal('passe');
            $table->integer('atk_rate');
            $table->integer('def_rate');

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
        Schema::table('jogadores', function (Blueprint $table) {
            //
        });
    }
}
