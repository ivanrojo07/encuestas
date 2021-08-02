<?php

namespace App\Http\Controllers;

use App\Models\Encuesta;
use Illuminate\Http\Request;

class EncuestaController extends Controller
{
    //

    public function index(){
        return view('encuesta.index');
    }

    public function show(Encuesta $encuesta){
        return view('encuesta.show',['encuesta'=>$encuesta]);
    }
}
