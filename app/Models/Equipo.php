<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;
    protected $table="equipos";

    public function jugadores(){
        return $this->hasMany(User::class);
    }

    public function solicitudes(){
        return $this->hasMany(Solicitud::class);
    }

    public function liga(){
        return $this->belongsTo(Liga::class);
    }


    public function visitantes()
    {
       return $this->hasMany(Jornada::class,'equipo_visitante');
    }
    public function locales()
    {
       return $this->hasMany(Jornada::class,'equipo_local');
    }
}
