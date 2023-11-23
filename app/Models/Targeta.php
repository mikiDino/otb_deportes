<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Targeta extends Model
{
    protected $fillable = [
        'nombre', 'jugador_id', 'fecha', 'cantidad_targetas',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }
}
