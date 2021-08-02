<?php

namespace App\Models;

use App\Models\Pregunta;
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
}
