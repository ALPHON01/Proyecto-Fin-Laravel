<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate)
    {

        $usuarios = User::paginate($paginate);
        return json_encode($usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = [];
        $usuario = new User();
        if (isset($request->name) && !empty($request->name)) {
            $usuario->name = $request->name;
        } else {
            array_push($errors, "Rellene el campo nombre. ");
        }
        if (isset($request->surname) && !empty($request->surname)) {
            $usuario->surname = $request->surname;
        } else {
            array_push($errors, "Rellene el campo apellidos. ");
        }
        if (isset($request->fecha_nac) && !empty($request->fecha_nac)) {
            if (preg_match("/[1-2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]/", $request->fecha_nac)) {
                $usuario->fecha_nac = $request->fecha_nac;
            } else {
                array_push($errors, "El formato de la fecha no es válido. ");
            }
        } else {
            array_push($errors, "Rellene el campo fecha nacimiento. ");
        }
        if (isset($request->role_id) && !empty($request->role_id)) {
            if ($request->role_id > 0 && $request->role_id < 4) {
                $usuario->role_id = $request->role_id;
            } else {
                array_push($errors, "Seleccione un rol válido. ");
            }
        } else {
            array_push($errors, "Seleccione un rol. ");
        }
        if (isset($request->email) && !empty($request->email)) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $usuario->email = $request->email;
            } else {
                array_push($errors, "El email no es válido. ");
            }
            if (User::where('email', $request->email)->first()) {
                array_push($errors, "El email ya está en nuestra Base de Datos. ");
            }
        } else {
            array_push($errors, "Rellene el campo email. ");
        }
        if (isset($request->password) && !empty($request->password)) {
            if (preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!^@#$%]{8,12}$/", $request->password)) {
                $usuario->password = sha1($request->password);
            } else {
                array_push($errors, "La contraseña debe tener entre 8 y 12 caracteres incluyendo letras mayúsculas, dígitos y carácteres especiales. ");
            }
        } else {
            array_push($errors, "La contraseña debe tener entre 8 y 12 caracteres incluyendo letras mayúsculas, dígitos y carácteres especiales. ");
        }



        if (count($errors) > 0) {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => $errors, 'usuario' => $usuario]);
        } else {
            $usuario->save();
            return json_encode(['status' => 200, 'statusText' => 'OK', 'message' => "Insertado Correctamente", 'usuario' => $usuario]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        return json_encode($usuario);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $errors = [];
        $usuario = User::findOrFail($id);
        if (isset($request->name) && !empty($request->name)) {
            $usuario->name = $request->name;
        } else {
            array_push($errors, "Rellene el campo nombre. ");
        }
        if (isset($request->surname) && !empty($request->surname)) {
            $usuario->surname = $request->surname;
        } else {
            array_push($errors, "Rellene el campo apellidos. ");
        }
        if (isset($request->fecha_nac) && !empty($request->fecha_nac)) {
            if (preg_match("/[1-2][0-9][0-9][0-9]-[0-1][0-9]-[0-3][0-9]/", $request->fecha_nac)) {
                $usuario->fecha_nac = $request->fecha_nac;
            } else {
                array_push($errors, "El formato de la fecha no es válido. ");
            }
        } else {
            array_push($errors, "Rellene el campo fecha nacimiento. ");
        }
        if (isset($request->role_id) && !empty($request->role_id)) {
            if ($request->role_id > 0 && $request->role_id < 4) {
                $usuario->role_id = $request->role_id;
            } else {
                array_push($errors, "Seleccione un rol válido. ");
            }
        } else {
            array_push($errors, "Seleccione un rol. ");
        }
        if (isset($request->email) && !empty($request->email)) {
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                if ($request->email != $usuario->email) {
                    if (User::where('email', $request->email)->count() != 0) {
                        array_push($errors, "El email ya está en nuestra Base de Datos. ");
                    } else {
                    }
                } else {
                    $usuario->email = $request->email;
                }
            } else {
                array_push($errors, "El email no es válido. ");
            }
        } else {
            array_push($errors, "Rellene el campo email. ");
        }
        if (isset($request->password) && !empty($request->password)) {
            if (preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!^@#$%]{8,12}$/", $request->password)) {
                $usuario->password = sha1($request->password);
            } else {
                array_push($errors, "La contraseña debe tener entre 8 y 12 caracteres incluyendo letras mayúsculas, dígitos y carácteres especiales. ");
            }
        } else {
        }



        if (count($errors) > 0) {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => $errors, 'usuario' => $usuario]);
        } else {
            $usuario->save();
            return json_encode(['status' => 200, 'statusText' => 'OK', 'message' => "Actualizado Correctamente", 'usuario' => $usuario]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $usuario = User::find($id)->delete();
            User::destroy($id);
            return json_encode(['status' => 200, 'statusText' => 'OK', 'message' => "Eliminado correctamente", 'usuario' => $usuario]);
        } catch (\Throwable $th) {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => "Procure eliminar al usuario en el resto de tablas"]);
        }
    }


    /**
     * Metodo para el login
     */
    public function login(Request $request)
    {

        if (empty($request->email)) {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => "Rellene los campos"]);
        }

        $email = User::where('email', 'like', $request->email)->first();
        $password = User::where('password', 'like', sha1($request->password))->first();

        if ($email) {
            if ($password) {

                return json_encode(['status' => 200, 'statusText' => 'OK', 'message' => "Logueado correctamente", 'token' => $request->email]);
            } else {
                return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => "Fallo en la contraseña"]);
            }
        } else {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => "El email no es correcto"]);
        }
    }


    public function getByEmail($email)
    {
        $usuario = User::where('email', '=', $email)->first();
        if ($usuario) {
            return json_encode(['status' => 200, 'statusText' => 'OK', 'message' => "Logueado correctamente", 'usuario' => $usuario]);
        } else {
            return json_encode(['status' => 400, 'statusText' => 'Bad Request', 'message' => "Ha ocurrido un error con el token loguease de nuevo"]);
        }
    }

    public function getEntrenadores()
    {
        $entrenadores = User::where('role_id', 2)->get();
        return json_encode($entrenadores);
    }
    public function getJugadores()
    {
        $jugadores = User::where('role_id', 3)->get();
        return json_encode($jugadores);
    }

    public function postFiltrado(Request $request)
    {

        $usuario = new User();
        $name = false;
        $surname = false;
        $email = false;
        $user=null;
        if(isset($request->name) && !empty($request->name)) {
            $usuario->name = '%'.$request->name.'%';
            $name = true;

        }
        if(isset($request->surname) && !empty($request->surname)) {
            $usuario->surname = '%'.$request->surname.'%';
            $surname = true;

        }
        if(isset($request->email) && !empty($request->email)) {
            $usuario->email = '%'.$request->email.'%';
           $email = true;
        }

        if ($name == true) {
            $user = User::where('name','like',$usuario->name);
            if ($surname == true) {
                $user->where('surname','like',$usuario->surname);
                if ($email == true) {
                    $user->where('email','like',$usuario->email);
                }
            }else{
                if ($email == true) {
                    $user->where('email','like',$usuario->email);
                }
            }
        }else{
           if ($surname == true) {
            $user = User::where('surname','like',$usuario->surname);
            if ($email == true) {
                $user->where('email','like',$usuario->email);
            }
           }else {
            if ($email == true) {
               $user = User::where('email','like',$usuario->email);

            }else {
                return json_encode(['status' => 400, 'statusText'=>'Bad Request', 'message'=> "Indique los campos de búsqueda"]);
            }
           }
        }
        return json_encode($user->get());


    }
}
