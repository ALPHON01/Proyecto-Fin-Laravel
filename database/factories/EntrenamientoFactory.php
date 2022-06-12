<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrenamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jugador_id'=>User::all()->where('role_id','=',3)->random()->id,
            'entrenador_id'=>User::all()->where('role_id','=',2)->random()->id,
            'duracion'=> $this->faker->numberBetween(1,5)

        ];
    }
}
