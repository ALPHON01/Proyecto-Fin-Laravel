<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liga extends Model
{
    use HasFactory;
    protected $table = "ligas";

    public function equipos(){
        return $this->hasMany(Equipo::class);
    }
}
