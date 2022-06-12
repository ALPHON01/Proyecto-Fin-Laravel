<?php

namespace Database\Factories;

use App\Models\Liga;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class EquipoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre'=>$this->faker->city(),
            'entrenador_id'=>User::all()->where('role_id',2)->random()->id,
            'liga_id'=>Liga::all()->random()->id,


        ];
    }
}
