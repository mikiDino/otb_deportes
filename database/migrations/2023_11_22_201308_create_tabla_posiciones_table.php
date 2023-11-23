<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablaPosicionesTable extends Migration
{
    public function up()
    {
        Schema::create('tabla_posiciones', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('equipo_id');
            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->integer('juegos_jugados');
            $table->integer('juegos_ganados');
            $table->integer('juegos_empatados');
            $table->integer('juegos_perdidos');
            $table->integer('goles_a_favor');
            $table->integer('goles_en_contra');
            $table->integer('puntos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tabla_posiciones');
    }
}
