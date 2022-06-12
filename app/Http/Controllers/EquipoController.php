<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function getAll()
    {
        $equipos = Equipo::all();
        return json_encode($equipos);
    }
    public function store(Request $request)
    {
        $errors=[];
        $equipo = new Equipo();
        if (isset($request->nombre) && !empty($request->nombre)) {
            $equipo->nombre = $request->nombre;
        }else {
            array_push($errors, "Rellene el campo nombre. ");
        }
        if (isset($request->entrenador_id) && !empty($request->entrenador_id)) {
            $equipo->entrenador_id = $request->entrenador_id;
        }else {
            array_push($errors, "Seleccione un entrenador. ");
        }
        if (isset($request->liga_id) && !empty($request->liga_id)) {
            $equipo->liga_id = $request->liga_id;
        }else {
            array_push($errors, "Seleccione un entrenador. ");
        }

        if (count($errors)>0) {
            return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> $errors,'equipo'=>$equipo]);
        }else {
            $equipo->save();
            return json_encode(['status' => 200, 'statusText'=>'OK', 'message'=> "Insertado Correctamente",'equipo'=>$equipo]);

        }

    }


}
