<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Opciones;

class OpcionesRespuestas extends Component
{
    public Opciones $opcion;
    public $activo;
    public function render()
    {
        return view('livewire.opciones-respuestas');
    }
}
