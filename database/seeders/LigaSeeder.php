<?php

namespace Database\Seeders;

use App\Models\Liga;
use Illuminate\Database\Seeder;


class LigaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Liga::factory(10)->create();
    }
}
