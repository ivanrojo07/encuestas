<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  App\Models\Pregunta  $pregunta
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Pregunta $pregunta, Request $request)
    {
        return view('preguntas.show',['pregunta'=>$pregunta]);
    }
}
