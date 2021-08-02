<?php

namespace App\Models;

use App\Models\Pregunta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Encuesta extends Model
{
    use HasFactory;

    protected $fillable=[
        'titulo',
        'descripcion'
    ];

    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }
    
}
