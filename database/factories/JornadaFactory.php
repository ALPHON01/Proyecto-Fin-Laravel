<?php

namespace Database\Factories;

use App\Models\Equipo;
use App\Models\Resultado;


use Illuminate\Database\Eloquent\Factories\Factory;

class JornadaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $local = Equipo::all()->random()->id;


        return [
            'equipo_local'=>$local,
            'equipo_visitante'=> $this->getVisitante($local),
            'fecha'=>$this->faker->date('Y-m-d'),
            'estado'=>rand(0,1),
            'resultado_id'=>Resultado::all()->random()->id,
        ];



    }

    public function getVisitante($localTeam)
    {
        $visitante = $localTeam;
        while ($visitante == $localTeam) {
            $visitante = Equipo::all()->random()->id;
        }
        return $visitante;
    }
}
