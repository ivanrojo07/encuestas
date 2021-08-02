<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta as EncuestaModel;

class Encuesta extends Component
{   
    public EncuestaModel $encuesta;

    public function render()
    {
        return view('livewire.encuesta');
    }

    
}
