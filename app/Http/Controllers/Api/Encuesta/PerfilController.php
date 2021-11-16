<?php

namespace App\Http\Controllers\Api\Encuesta;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PerfilRequest;

class PerfilController extends Controller
{
    //

    public function register(PerfilRequest $request){
        $perfil = Perfil::create($request->all());
        return response()->json([
            'message'=>'success',
            'token'=>$perfil->token
        ],201);
    }

    public function show(Request $request){
        if($request->perfil){
            return response()->json([
                'message'=>'success',
                'perfil' => $request->perfil
            ],200);
        }
        else{
            return response()->json([
                'message'=>'failed',
                'perfil'=>null
            ],404);
        }
    }
}
