<?php

namespace Database\Seeders;

use App\Models\Jornada;
use App\Models\Resultado;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(
            [
                RoleSeeder::class,
                UserSeeder::class,
                EntrenamientoSeeder::class,
                LigaSeeder::class,
                EquipoSeeder::class,
                SolicitudSeeder::class,
                ResultadoSeeder::class,
                JornadaSeeder::class,

            ]
        );
    }
}
