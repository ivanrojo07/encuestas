<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pregunta;
use App\Models\Opciones as OpcionModel;

class Opciones extends Component
{
    public Pregunta $pregunta;
    public $opciones;
    public $showCardForm = false;
    public $showDeleteCard = false;
    public $opcion_id = null;
    public $opcion="";
    public $valor="";

    protected $rules=[
        'opcion_id'=> 'nullable|numeric',
        'opcion' => 'required|string|max:255',
        'valor' => 'nullable|numeric|min:0',
    ];

    public function render()
    {
        $this->opciones = OpcionModel::where('pregunta_id',$this->pregunta->id)->orderBy('id')->get();
        return view('livewire.opciones');
    }

    public function saveOpcion(){
        if($this->opcion_id){
            OpcionModel::find($this->opcion_id)->update([
                'opcion'=>$this->opcion,
                'valor'=>$this->valor
            ]);
        }
        else{
            $opc = new OpcionModel([
                'opcion'=>$this->opcion,
                'valor'=>$this->valor
            ]);
            $this->pregunta->opciones()->save($opc);
        }
        $this->resetState();
    }

    public function updateOpcion($opcion_id)
    {
        $opc = OpcionModel::find($opcion_id);
        $this->opcion_id = $opc->id;
        $this->opcion = $opc->opcion;
        $this->valor = $opc->valor;
        $this->showCardForm = true;
    }
    public function deleteOpcion($opcion_id)
    {
        $opc = OpcionModel::find($opcion_id);
        $this->opcion_id = $opc->id;
        $this->opcion = $opc->opcion;
        $this->valor = $opc->valor;
        $this->showDeleteCard = true;
    }
    public function deleteSubmitOpcion($opcion_id)
    {
        OpcionModel::find($opcion_id)->delete();
        $this->resetState();
    }

    public function resetState()
    {
        $this->opciones = OpcionModel::where('pregunta_id',$this->pregunta->id)->orderBy('id')->get();
        $this->showCardForm = false;
        $this->showDeleteCard = false;
        $this->opcion_id = null;
        $this->opcion = "";
        $this->valor = "";
    }
}
