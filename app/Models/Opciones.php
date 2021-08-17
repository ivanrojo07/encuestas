<?php

namespace App\Models;

use App\Models\Pregunta;
use App\Models\Respuesta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opciones extends Model
{
    use HasFactory;

    protected $fillable=[
        'pregunta_id',
        'opcion',
        'valor'
    ];

    public function pregunta(){
        return $this->belongsTo(Pregunta::class);
    }

    public function respuestas(){
        return $this->hasMany(Respuesta::class, 'opcion_id','id');
    }

    public function getTotalRespuestasAttribute(){
        return count($this->respuestas);
    }
    public function getPorcentajeRespuestasAttribute(){
        if($this->pregunta->total_respuestas < 1){
            return 0;
        }
        $porcent = ($this->total_respuestas/$this->pregunta->total_respuestas)*100;
        return round($porcent,2);
    }
}
