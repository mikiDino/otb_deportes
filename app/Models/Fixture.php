<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $table = 'fixture';

    protected $fillable = [
        'equipo_local_id',
        'equipo_visitante_id',
        'fecha',
        'resultado_local',
        'resultado_visitante',
        // Otros campos relacionados con la información del fixture
    ];

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class, 'equipo_local_id');
    }

    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class, 'equipo_visitante_id');
    }
}
