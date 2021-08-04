<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Respuesta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RespuestaRequest;

class RespuestaController extends Controller
{
    //
    public function sendRespuesta(RespuestaRequest $request){
        $respuesta = Respuesta::create([
            'perfil_id'=>$request->perfil_id,
            'pregunta_id'=>$request->pregunta_id,
            'opcion_id'=>$request->opcion_id
        ]);
        return response()->json(['message'=>"success",'respuest'=>$respuesta]);
        
    }
}
