<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReverseJugadoresSeeder extends Seeder
{
    public function run()
    {
        // Eliminar los jugadores agregados por el seeder JugadoresSeeder
        DB::table('jugadores')->truncate();
    }
}
