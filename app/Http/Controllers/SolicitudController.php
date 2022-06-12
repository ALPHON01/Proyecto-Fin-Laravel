<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;

use Illuminate\Http\Request;


class SolicitudController extends Controller
{
    public function getAll()
    {
        $solicitudes = Solicitud::all();
        return json_encode($solicitudes);
    }

    public function cambiarEstado(Request $request)
    {
        $solicitud = Solicitud::find($request->id);
        if($request->estado == 0){
            $solicitud->estado = 1;
        }else{
            $solicitud->estado = 0;
        }
        $solicitud->save();
        return json_encode(['status'=>200,"message"=>"Operacion realizada correctamente"]);

    }
    public function misEquipos($id)
    {   try {
        $equipos = Solicitud::where('usuario_id',$id)->get();
        if(count($equipos) == 0){
            return json_encode(['status'=>400,'statusText'=>'Bad Request',"message"=>"No se ha alistado a ningun equipo"]);
        }else{
            return json_encode($equipos);
        }

    } catch (\Throwable $th) {
        return json_encode(['status'=>400,"message"=>"No se ha alistado a ningun equipo"]);
    }
    }
    public function apuntarEquipo(Request $request)
    {
        //Para comprobar si existe esa solicitud
        $solicitud = Solicitud::where('usuario_id',$request->usuario_id)->where('equipo_id',$request->equipo_id)->first();
        if ($solicitud) {
            return json_encode(['status'=>400,"message"=>"Ya se ha apuntado a este equipo"]);
        }else {
            $nueva = new Solicitud();
            $nueva->usuario_id = $request->usuario_id;
            $nueva->equipo_id = $request->equipo_id;
            $nueva->estado = 0;
            $nueva->save();
            return json_encode(['status'=>200,"message"=>"Apuntado Exitosamente"]);
        }
    }

    public function borrarSolicitud(Request $request)
    {
        try {
            $solicitud = Solicitud::find($request->id)->delete();
            Solicitud::destroy($request->id);
            return json_encode(['status' => 200, 'statusText'=>'OK', 'message'=> "Eliminado correctamente",'solicitud'=>$solicitud]);

        } catch (\Throwable $th) {
            return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> "No se ha podido eliminar consulte con el admin"]);
        }
    }


}
