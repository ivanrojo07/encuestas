<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pregunta as PreguntaModel;

class Pregunta extends Component
{
    public $pregunta;
    public $option = "edad";
    public $graph = "bar";
    function mount(PreguntaModel $pregunta){
        $this->pregunta = $pregunta;
    }
    public function render()
    {
        return view('livewire.pregunta');
    }
}
