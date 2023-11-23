<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = [
        'nombre', 'representante', 'celular_representante', 'categoria_id',
    ];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
    public function partidosLocal()
    {
        return $this->hasMany(Fixture::class, 'equipo_local_id');
    }

    public function partidosVisitante()
    {
        return $this->hasMany(Fixture::class, 'equipo_visitante_id');
    }
}
