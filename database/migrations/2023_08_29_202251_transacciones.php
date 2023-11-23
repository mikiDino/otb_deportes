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
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipo_id')->nullable();
            $table->unsignedBigInteger('partido_id')->nullable();
            $table->string('tipo'); // Ingreso o Egreso
            $table->string('descripcion');
            $table->decimal('monto', 10, 2);
            $table->timestamps();

            $table->foreign('equipo_id')->references('id')->on('equipos');
            $table->foreign('partido_id')->references('id')->on('partidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacciones');
    }
};
