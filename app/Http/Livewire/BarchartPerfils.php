<?php

namespace App\Http\Livewire;

use App\Models\Perfil;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class BarchartPerfils extends Component
{

    public $field;
    public $respuestas;
    public $opciones;
    public $opt;
    public $data;
    public $graph;

    function mount($graph, $field, $respuestas, $opciones){
        $this->field = $field;
        $this->respuestas = $respuestas;
        $this->opciones = $opciones;
        $this->graph = $graph;
        $this->opt = Perfil::select($this->field)->distinct()->orderBy($this->field,"ASC")->get()->pluck($this->field);
        $this->data =
            DB::table('respuestas')
                ->join('opciones','respuestas.opcion_id','=','opciones.id')
                ->join('perfils', 'respuestas.perfil_id','=','perfils.id')
                ->selectRaw('opciones.opcion, count(*) as perfil_count, '.$this->field)->whereIn('opciones.id',$this->opciones->pluck('id'))->whereIn("perfils.".$this->field,$this->opt)->groupBy('perfils.'.$this->field,'opciones.id')
                ->get()->groupBy(['opcion',$this->field]);

    }

    public function render()
    {
        return view('livewire.barchart-perfils');
    }
}
