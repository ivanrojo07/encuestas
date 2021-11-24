<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreguntaController extends Controller
{
    
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $preguntas = Pregunta::where('activo', true)->get();
        $response = $preguntas->reject(function($pregunta){
            return $pregunta->date_end->lte(date(now()));
        });
        $collection = array();
        foreach($response as $res){
            array_push($collection, $res->load('opciones'));
        }
        return response()->json(['preguntas'=>$collection,'date_now'=>date(now())],200);

    }
}
