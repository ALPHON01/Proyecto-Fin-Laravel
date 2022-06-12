<?php

namespace Database\Seeders;

use App\Models\Jornada;
use Illuminate\Database\Seeder;

class JornadaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jornada::factory(100)->create();
    }
}
