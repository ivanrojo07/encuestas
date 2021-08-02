<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pregunta;

class Preguntas extends Component
{
    public $encuesta;
    public $preguntas;
    public $showModalForm = false;
    public $showDeletePreguntaModal = false;
    
    public $pregunta_id;
    public $pregunta;
    public $subtitle;
    public $duracion;

    protected $rules = [
        'pregunta_id'=> 'nullable|numeric',
        'pregunta' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'duracion' => 'required|numeric',
    ];
    

    public function mount(){
        $this->preguntas = $this->encuesta->preguntas;
    }

    public function render()
    {
        return view('livewire.preguntas');
    }

    public function savePregunta(){
        
        $this->validate();
        if($this->pregunta_id){
            Pregunta::find($this->pregunta_id)->update([
                'pregunta'=>$this->pregunta,
                'subtitle'=>$this->subtitle,
                'duracion'=>date('H:i:s',($this->duracion*60)),
            ]);
        }
        else{
            $pregunta = new Pregunta([
                'pregunta'=>$this->pregunta,
                'subtitle'=>$this->subtitle,
                'duracion'=>date('H:i:s',($this->duracion*60)),
            ]);

            $this->encuesta->preguntas()->save($pregunta);
        }
        $this->resetState();
    }

    public function editPregunta($pregunta_id)
    {
        $pregunta = Pregunta::find($pregunta_id);
        if($pregunta){
            $this->pregunta_id = $pregunta->id;
            $this->pregunta = $pregunta->pregunta;
            $this->subtitle = $pregunta->subtitle;
            $this->duracion = $pregunta->duracion;
        }
        $this->showModalForm = true;
    }

    public function deletePregunta($pregunta_id)
    {
        $pregunta = Pregunta::find($pregunta_id);
        if($pregunta){
            $this->pregunta_id = $pregunta->id;
            $this->pregunta = $pregunta->pregunta;
            $this->subtitle = $pregunta->subtitle;
            $this->duracion = $pregunta->duracion;
        }
        $this->showDeletePreguntaModal = true;
    }

    public function deleteSubmitPregunta($pregunta_id)
    {
        $pregunta = Pregunta::find($pregunta_id);
        if($pregunta){
            $pregunta->delete();
        }
        $this->resetState();
    }

    public function resetState()
    {
        $this->preguntas = $this->encuesta->preguntas()->orderBy('id','ASC')->get();
        $this->showModalForm = false;
        $this->showDeletePreguntaModal = false;
        $this->pregunta_id = null;
        $this->pregunta = '';
        $this->subtitle = '';
        $this->duracion = '';

    }

}
