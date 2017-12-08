<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estadios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('time_id');
            $table->integer('capacidade');
            $table->decimal('valor_ingresso');

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
        Schema::table('estadios', function (Blueprint $table) {
            //
        });
    }
}
