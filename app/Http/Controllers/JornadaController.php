<?php

namespace App\Http\Controllers;

use App\Models\Jornada;
use Illuminate\Http\Request;


class JornadaController extends Controller
{
    public function getAll()
    {
        $jornadas = Jornada::all();
        return json_encode($jornadas);
    }

    public function store(Request $request)
    {
        $errors=[];
        $jornada = new Jornada();
        if (isset($request->equipo_local) && !empty($request->equipo_local)) {

            $jornada->equipo_local = $request->equipo_local;
        }else {
            array_push($errors, "Rellene el campo Equipo Local. ");
        }
        if (isset($request->equipo_visitante) && !empty($request->equipo_visitante)) {
            if ($request->equipo_local == $request->equipo_visitante) {
                array_push($errors, "No puedes poner el mismo equipo en Local y Visitante. ");
            }else{
                $jornada->equipo_visitante = $request->equipo_visitante;
            }

        }else {
            array_push($errors, "Rellene el campo Equipo Local. ");
        }
        if (isset($request->fecha) && !empty($request->fecha)) {
            if (preg_match("/[1-2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]/",$request->fecha) ) {
                $jornada->fecha = $request->fecha;
            }else{
                 array_push($errors, "El formato de la fecha no es válido. ");
            }

        }else {
            array_push($errors, "Rellene el campo fecha. ");
        }

            if ($request->estado ==0 || $request->estado == 1) {
                $jornada->estado = $request->estado;
            }else {
                array_push($errors, "Seleccione un estado válido. ");
            }


        if (isset($request->resultado_id) && !empty($request->resultado_id)) {
            if ($request->resultado_id == 3|| $request->resultado_id == 1 || $request->resultado_id == 2) {
                $jornada->resultado_id = $request->resultado_id;
            }else {
                array_push($errors, "Seleccione un resultado válido. ");
            }

        }else{
            array_push($errors, "Seleccione un resultado. ");
        }

        if (count($errors)>0) {
            return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> $errors,'jornada'=>$jornada]);
        }else {
            try {
                $jornada->save();
                return json_encode(['status' => 200, 'statusText'=>'OK', 'message'=> "Insertado Correctamente",'jornada'=>$jornada]);
            } catch (\Throwable $th) {
                return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> "Compruebe que la fecha sea válida",'jornada'=>$jornada]);
            }


        }

    }
}
