<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TablaPosiciones extends Model
{
    protected $table = 'tabla_posiciones';

    protected $fillable = [
        'equipo_id',
        'juegos_jugados',
        'juegos_ganados',
        'juegos_empatados',
        'juegos_perdidos',
        'goles_a_favor',
        'goles_en_contra',
        'puntos',
        // Otros campos relacionados con la tabla de posiciones
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
