<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RespuestaRequest;

class RespuestaController extends Controller
{
    //
    public function sendRespuesta(RespuestaRequest $request){
        $pregunta = Pregunta::find($request->pregunta_id);
        if(strtotime(now()) <= strtotime($pregunta->date_end)){
            $respuesta = Respuesta::create([
                'perfil_id'=>$request->perfil_id,
                'pregunta_id'=>$request->pregunta_id,
                'opcion_id'=>$request->opcion_id
            ]);
            return response()->json(['message'=>"success",'respuest'=>$respuesta]);
        }
        else{
            abort(403, 'La encuesta ha expirado');
        }
        
    }
}
