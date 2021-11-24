<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\Encuesta\PerfilController;
use App\Http\Controllers\Api\Encuesta\PreguntaController;
use App\Http\Controllers\Api\Encuesta\RespuestaController;

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


Route::post('/auth/register',[AuthController::class,'register']);
Route::post('/auth/login',[AuthController::class,'login']);

// Registrar perfil movil en app
Route::post('perfil/register',[PerfilController::class,'register']);
// mostrar perfil de usuario
Route::get('perfil',[PerfilController::class,'show'])->middleware('jwt');
Route::middleware('jwt')->post('respuesta/',[RespuestaController::class,'sendRespuesta']);
Route::middleware('jwt')->get('preguntas/',PreguntaController::class);