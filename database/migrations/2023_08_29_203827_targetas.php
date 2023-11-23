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
        Schema::create('targetas', function (Blueprint $table) {
            $table->id();
            $table->enum('nombre', ['amarilla', 'roja']);
            $table->unsignedBigInteger('jugador_id');
            $table->date('fecha');
            $table->integer('cantidad_targetas');
            $table->timestamps();

            $table->foreign('jugador_id')->references('id')->on('jugadores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarjetas');
    }
};
