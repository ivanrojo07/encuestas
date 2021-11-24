<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;

class PreguntaController extends Controller
{
    
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $perfil = $request->perfil;
        $preguntas = Pregunta::where('activo', true)->whereHas('respuestas',function(Builder $query) use($perfil) {
            $query->where('perfil_id', "!=", $perfil['id']);
        })->get();
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
