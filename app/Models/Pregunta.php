<?php

namespace App\Models;

use App\Models\Encuesta;
use App\Models\Opciones;
use App\Models\Respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pregunta extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'pregunta',
        'subtitle',
        'duracion',
    ];

    public function encuesta(){
        return $this->belongsTo(Encuesta::class);
    }

    public function opciones(){
        return $this->hasMany(Opciones::class);
    }

    public function respuestas(){
        return $this->hasMany(Respuesta::class);
    }
}
