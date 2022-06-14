<?php

use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\JornadaController;
use App\Http\Controllers\LigaController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\UserController;
use App\Models\Jornada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users/{paginate}', [UserController::class,'index']);
Route::post('/users/add', [UserController::class,'store']);
Route::post('/auth', [UserController::class,'login']);
Route::get('/users/{id}', [UserController::class,'show']);
Route::put('/users/{id}',[UserController::class,'update']);
Route::delete('/users/{id}',[UserController::class,'destroy']);
Route::post('/users/{email}',[UserController::class,'getByEmail']);
Route::get('/entrenadores/all',[UserController::class,'getEntrenadores']);
Route::get('/jugadores/all',[UserController::class,'getJugadores']);
Route::post('/usuario/filtrar',[UserController::class,'postFiltrado']);



Route::get('/solicitudes/all',[SolicitudController::class,'getAll']);
Route::get('/solicitudes/misequipos/{id}',[SolicitudController::class,'misEquipos']);
Route::post('/solicitudes/cambiar',[SolicitudController::class,'cambiarEstado']);
Route::post('/solicitudes/add',[SolicitudController::class,'apuntarEquipo']);
Route::delete('/solicitudes/borrar',[SolicitudController::class,'borrarSolicitud']);

Route::get('/equipos/all',[EquipoController::class,'getAll']);
Route::post('/equipo/add', [EquipoController::class,'store']);

Route::get('/ligas/all',[LigaController::class,'getAll']);


Route::get('/jornadas/all',[JornadaController::class,'getAll']);
Route::post('/jornadas/add', [JornadaController::class,'store']);

Route::get('/entrenamientos/misentrenamientos/{id}',[EntrenamientoController::class,'misEntrenos']);
Route::get('/entrenamientos/misentrenados/{id}',[EntrenamientoController::class,'misEntrenados']);
Route::get('/entrenamientos/all',[EntrenamientoController::class,'getAll']);
Route::post('/entrenamientos/add', [EntrenamientoController::class,'store']);
Route::delete('/entrenamientos/borrar',[EntrenamientoController::class,'borrarEntrenamiento']);

