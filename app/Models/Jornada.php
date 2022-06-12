<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;
    protected $table = "jornadas";

    public function equipoLocal()
    {
        return $this->belongsTo(Equipo::class,'equipo_local');
    }
    public function equipoVisitante()
    {
        return $this->belongsTo(Equipo::class,'equipo_visitante');
    }

    public function resultado()
    {
        return $this->belongsTo(Resultado::class);
    }



}
