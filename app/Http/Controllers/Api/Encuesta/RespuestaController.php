<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RespuestaController extends Controller
{
    //
    public function sendRespuesta(Request $request){
        $request->validate([
            'pregunta_id'=>'required|exists:preguntas,id',
            'opcion_id'=>'required|exists:opciones,id'
        ]);
        $perfil = $request->perfil;
        $pregunta = Pregunta::find($request->pregunta_id);
        if(strtotime(now()) <= strtotime($pregunta->date_end)){
            $respuesta = Respuesta::create([
                'perfil_id'=>$perfil['id'],
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
