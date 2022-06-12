<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ["Admin","Entrenador","Cliente"];
        for ($i=0; $i <count($roles) ; $i++){
            Role::create(array("name"=> $roles[$i]));
        }
    }
}
