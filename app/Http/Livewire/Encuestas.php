<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Encuesta as EncuestaModel;

class Encuestas extends Component
{

    public $encuestas;
    public $showEncuestaModal = false;
    public $showDeleteEncuestaModal = false;

    public $encuesta_id = null;
    public $titulo = "";
    public $descripcion = "";

    protected $rules = [
        'titulo' => 'required|string',
        'descripcion' => 'nullable|string',
    ];

    public function mount(){
        $this->encuestas = EncuestaModel::orderBy('id','ASC')->get();
    }

    public function render()
    {
        return view('livewire.encuestas');
    }

    public function saveEncuesta(){
        $this->validate();
        if($this->encuesta_id){
            EncuestaModel::find($this->encuesta_id)->update([
                'titulo'=>$this->titulo,
                'descripcion'=>$this->descripcion
            ]);
        }
        else{
            EncuestaModel::create([
                'titulo'=>$this->titulo,
                'descripcion'=>$this->descripcion
            ]);
        }
        $this->resetState();
    }

    public function editEncuesta($encuesta_id){
        $encuesta = EncuestaModel::find($encuesta_id);
        if($encuesta){
            $this->encuesta_id = $encuesta->id;
            $this->titulo = $encuesta->titulo;
            $this->descripcion = $encuesta->descripcion;
        }
        $this->showEncuestaModal = true;
    }

    public function deleteEncuesta($encuesta_id){
        $encuesta = EncuestaModel::find($encuesta_id);
        if($encuesta){
            $this->encuesta_id = $encuesta->id;
            $this->titulo = $encuesta->titulo;
            $this->descripcion = $encuesta->descripcion;
        }
        $this->showDeleteEncuestaModal = true;
    }

    public function deleteSubmitEncuesta($encuesta_id){
        EncuestaModel::find($encuesta_id)->delete();
        $this->resetState();
    }

    public function resetState(){
        $this->showEncuestaModal = false;
        $this->showDeleteEncuestaModal = false;
        $this->encuestas = EncuestaModel::orderBy('id','ASC')->get();
        $this->encuesta_id = null;
        $this->titulo = "";
        $this->descripcion = "";
    }
}
