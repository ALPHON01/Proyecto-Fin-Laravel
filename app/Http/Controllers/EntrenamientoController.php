<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use Illuminate\Http\Request;

class EntrenamientoController extends Controller
{
    public function getAll()
    {
        $entrenamientos = Entrenamiento::all();
        return json_encode($entrenamientos);
    }

    public function misEntrenos($id)
    {
       $entrenamientos = Entrenamiento::where('jugador_id',$id);
        if($entrenamientos->count() >0){
            return json_encode($entrenamientos->get());
        }else {

        }
    }

    public function misEntrenados($id)
    {
        $entrenamientos = Entrenamiento::where('entrenador_id',$id);
        if($entrenamientos->count() >0){
            return json_encode($entrenamientos->get());
        }else {

        }
    }

    public function store(Request $request)
    {

        $errors=[];
        $entrenamiento = new Entrenamiento();
        if (isset($request->jugador_id) && !empty($request->jugador_id)) {
            $entrenamiento->jugador_id = $request->jugador_id;
        }else {
            array_push($errors, "Rellene el campo jugador_id. ");
        }
        if (isset($request->entrenador_id) && !empty($request->entrenador_id)) {
            $entrenamiento->entrenador_id = $request->entrenador_id;
        }else {
            array_push($errors, "Rellene el campo entrenador. ");
        }
        if (isset($request->duracion) && !empty($request->duracion)) {
            $entrenamiento->duracion = $request->duracion;
        }else {
            array_push($errors, "Rellene el campo duracion. ");
        }

        if (count($errors)>0) {
            return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> $errors,]);
        }else {
            $entrenamiento->save();
            return json_encode(['status' => 200, 'statusText'=>'OK', 'message'=> "Insertado Correctamente"]);

        }
    }

    public function borrarEntrenamiento(Request $request)
    {
        try {
            $solicitud = Entrenamiento::find($request->id)->delete();
            Entrenamiento::destroy($request->id);
            return json_encode(['status' => 200, 'statusText'=>'OK', 'message'=> "Eliminado correctamente"]);

        } catch (\Throwable $th) {
            return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> "No se ha podido eliminar consulte con el admin"]);
        }
    }
}
