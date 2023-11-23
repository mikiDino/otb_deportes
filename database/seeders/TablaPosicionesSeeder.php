<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaPosicionesSeeder extends Seeder
{
    public function run()
    {
        // Obtener IDs de equipos con categoria_id 4
        $equiposIds = DB::table('equipos')->where('categoria_id', 4)->pluck('id')->toArray();

        foreach ($equiposIds as $equipoId) {
            // Juegos jugados
            $juegosJugados = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where(function ($query) use ($equipoId) {
                    $query->where('equipo_local_id', $equipoId)
                        ->orWhere('equipo_visitante_id', $equipoId);
                })
                ->count();

            // Juegos ganados
            $juegosGanados = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where(function ($query) use ($equipoId) {
                    $query->where(function ($query) use ($equipoId) {
                        $query->where('equipo_local_id', $equipoId)
                            ->whereColumn('resultado_local', '>', 'resultado_visitante');
                    })->orWhere(function ($query) use ($equipoId) {
                        $query->where('equipo_visitante_id', $equipoId)
                            ->whereColumn('resultado_visitante', '>', 'resultado_local');
                    });
                })
                ->count();

            // Juegos empatados
            $juegosEmpatados = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where('resultado_local', DB::raw('resultado_visitante'))
                ->count();

            // Juegos perdidos
            $juegosPerdidos = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where(function ($query) use ($equipoId) {
                    $query->where(function ($query) use ($equipoId) {
                        $query->where('equipo_local_id', $equipoId)
                            ->whereColumn('resultado_local', '<', 'resultado_visitante');
                    })->orWhere(function ($query) use ($equipoId) {
                        $query->where('equipo_visitante_id', $equipoId)
                            ->whereColumn('resultado_visitante', '<', 'resultado_local');
                    });
                })
                ->count();

            // Goles a favor
            $golesAFavor = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where(function ($query) use ($equipoId) {
                    $query->where(function ($query) use ($equipoId) {
                        $query->where('equipo_local_id', $equipoId)
                            ->whereColumn('resultado_local', '>', 'resultado_visitante');
                    })->orWhere(function ($query) use ($equipoId) {
                        $query->where('equipo_visitante_id', $equipoId)
                            ->whereColumn('resultado_visitante', '>', 'resultado_local');
                    });
                })
                ->sum(DB::raw("CASE
                    WHEN equipo_local_id = $equipoId THEN resultado_local
                    ELSE resultado_visitante
                END"));

            // Goles en contra
            $golesEnContra = DB::table('fixture')
                ->where('fecha', '<', now())
                ->where(function ($query) use ($equipoId) {
                    $query->where(function ($query) use ($equipoId) {
                        $query->where('equipo_local_id', $equipoId)
                            ->whereColumn('resultado_local', '<', 'resultado_visitante');
                    })->orWhere(function ($query) use ($equipoId) {
                        $query->where('equipo_visitante_id', $equipoId)
                            ->whereColumn('resultado_visitante', '<', 'resultado_local');
                    });
                })
                ->sum(DB::raw("CASE
                    WHEN equipo_local_id = $equipoId THEN resultado_visitante
                    ELSE resultado_local
                END"));

            // Calcular puntos
            $puntos = $juegosGanados * 3;

            // Insertar en la tabla
            DB::table('tabla_posiciones')->insert([
                'equipo_id' => $equipoId,
                'juegos_jugados' => $juegosJugados,
                'juegos_ganados' => $juegosGanados,
                'juegos_empatados' => $juegosEmpatados,
                'juegos_perdidos' => $juegosPerdidos,
                'goles_a_favor' => $golesAFavor,
                'goles_en_contra' => $golesEnContra,
                'puntos' => $puntos,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
