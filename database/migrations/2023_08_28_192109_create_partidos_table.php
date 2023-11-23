<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->unsignedBigInteger('equipo1_id');
            $table->unsignedBigInteger('equipo2_id');
            $table->string('resultado')->nullable();
            $table->timestamps();

            $table->foreign('equipo1_id')->references('id')->on('equipos');
            $table->foreign('equipo2_id')->references('id')->on('equipos');
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
