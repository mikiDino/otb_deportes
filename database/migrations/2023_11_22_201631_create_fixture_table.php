<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixtureTable extends Migration
{
    public function up()
    {
        Schema::create('fixture', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('equipo_local_id');
            $table->foreign('equipo_local_id')->references('id')->on('equipos');
            $table->unsignedBigInteger('equipo_visitante_id');
            $table->foreign('equipo_visitante_id')->references('id')->on('equipos');
            $table->timestamp('fecha');
            $table->integer('resultado_local')->comment('Goles equipo local');
            $table->integer('resultado_visitante')->comment('Goles equipo visitante');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fixture');
    }
}
