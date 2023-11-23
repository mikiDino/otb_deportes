<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = 'jugadores';
    protected $fillable = [
        'nombre', 'apellidos', 'edad', 'equipo_id',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function tarjetas()
    {
        return $this->hasMany(Targeta::class);
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'equipo_id', 'id');
    }
}
