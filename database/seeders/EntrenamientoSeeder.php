<?php

namespace Database\Seeders;

use App\Models\Entrenamiento;

use Illuminate\Database\Seeder;

class EntrenamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entrenamiento::factory(10)->create();
    }
}
