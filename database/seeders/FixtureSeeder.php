<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FixtureSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Obtener IDs de equipos con categoria_id 4
        $equiposIds = DB::table('equipos')->where('categoria_id', 4)->pluck('id')->toArray();

        // Generar 8 registros para el 5 de noviembre de 2023
        for ($i = 0; $i < 8; $i++) {
            DB::table('fixture')->insert([
                'equipo_local_id' => $faker->randomElement($equiposIds),
                'equipo_visitante_id' => $faker->randomElement($equiposIds),
                'fecha' => '2023-11-05',
                'resultado_local' => $faker->numberBetween(0, 5),
                'resultado_visitante' => $faker->numberBetween(0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Generar 8 registros para el 12 de noviembre de 2023
        for ($i = 0; $i < 8; $i++) {
            DB::table('fixture')->insert([
                'equipo_local_id' => $faker->randomElement($equiposIds),
                'equipo_visitante_id' => $faker->randomElement($equiposIds),
                'fecha' => '2023-11-12',
                'resultado_local' => $faker->numberBetween(0, 5),
                'resultado_visitante' => $faker->numberBetween(0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
