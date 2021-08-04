<?php

namespace App\Models;

use App\Models\Encuesta;
use App\Models\Opciones;
use App\Models\Respuesta;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pregunta extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'pregunta',
        'subtitle',
        'duracion',
        'activo'
    ];

    public function getDateEndAttribute(){
        $time = explode(':',$this->duracion);
        $date = new Carbon($this->updated_at);
        return $date->addHours($time[0])->addMinutes($time[1])->addSeconds($time[2]);
        // return date('Y-m-d H:i:s', strtotime($this->updated_at)+strtotime('00-00'.$this->duracion));


    }

    public function getTotalRespuestasAttribute(){
        return count($this->respuestas);
    }

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
