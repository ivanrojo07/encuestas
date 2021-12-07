<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\PreguntaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::prefix('/encuestas')->name('encuestas.')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/',[EncuestaController::class,'index'])->name('index');
    Route::get('/{encuesta}',[EncuestaController::class,'show'])->name('show');
});

Route::middleware(['auth:sanctum', 'verified'])->get('preguntas/{pregunta}', PreguntaController::class)->name('preguntas.show');