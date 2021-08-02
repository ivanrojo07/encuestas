<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RespuestaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'perfil_id'=>'required|exists:perfils,id',
            'pregunta_id'=>'required|exists:preguntas,id',
            'opcion_id'=>'required|exists:opciones,id'
        ];
    }
}
