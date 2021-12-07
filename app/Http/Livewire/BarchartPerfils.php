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

    function mount($field, $respuestas, $opciones){
        $this->field = $field;
        $this->respuestas = $respuestas;
        $this->opciones = $opciones;
        $this->opt = Perfil::select($field)->distinct()->orderBy($field,"ASC")->get()->pluck($field);
        $this->data =
            DB::table('respuestas')
                ->join('opciones','respuestas.opcion_id','=','opciones.id')
                ->join('perfils', 'respuestas.perfil_id','=','perfils.id')
                ->selectRaw('opciones.opcion, count(*) as perfil_count, '.$field)->whereIn('opciones.id',$opciones->pluck('id'))->whereIn("perfils.".$this->field,$this->opt)->groupBy('perfils.'.$field,'opciones.id')
                ->get()->groupBy(['opcion',$field]);

    }

    public function render()
    {
        return view('livewire.barchart-perfils');
    }
}
