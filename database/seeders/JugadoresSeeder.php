<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class JugadoresSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $equiposIds = DB::table('equipos')->where('categoria_id', 5)->pluck('id')->toArray();

        foreach ($equiposIds as $equipoId) {
            for ($i = 0; $i < 11; $i++) {
                DB::table('jugadores')->insert([
                    'nombre' => $faker->firstNameMale,
                    'apellidos' => $faker->lastName,
                    'edad' => $faker->numberBetween(18, 40),
                    'equipo_id' => $equipoId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
