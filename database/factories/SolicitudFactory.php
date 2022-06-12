<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'usuario_id'=>User::all()->where('role_id',3)->random()->id,
            'equipo_id'=>Equipo::all()->random()->id,
            'estado'=>rand(0,1),
        ];
    }
}
