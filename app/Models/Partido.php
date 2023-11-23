<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $fillable = [
        'fecha', 'equipo1_id', 'equipo2_id', 'resultado', 'goles_equipo1', 'goles_equipo2',
    ];

    public function equipo1()
    {
        return $this->belongsTo(Equipo::class, 'equipo1_id');
    }

    public function equipo2()
    {
        return $this->belongsTo(Equipo::class, 'equipo2_id');
    }
}
