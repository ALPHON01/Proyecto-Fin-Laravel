<?php

namespace Database\Seeders;

use App\Models\Resultado;


use Illuminate\Database\Seeder;

class ResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resultados = ["1","X","2"];
        for ($i=0; $i <count($resultados) ; $i++){
            Resultado::create(array("resultado"=> $resultados[$i]));
        }
    }
}
