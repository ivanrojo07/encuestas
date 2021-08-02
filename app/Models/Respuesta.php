<?php

namespace App\Models;

use App\Models\Perfil;
use App\Models\Opciones;
use App\Models\Pregunta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable=[
        'pregunta_id',
        'perfil_id',
        'opcion_id',
    ];

    public function pregunta(){
        return $this->belongsTo(Pregunta::class);
    }

    public function opcion(){
        return $this->belongsTo(Opciones::class);
    }

    public function perfil(){
        return $this->belongsTo(Perfil::class);
    }

}
