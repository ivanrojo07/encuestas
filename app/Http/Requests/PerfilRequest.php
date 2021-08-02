<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfilRequest extends FormRequest
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
            'nombre'=>'required|string|max:255',
            'apellido'=>'nullable|string|max:255',
            'email'=>'nullable|email',
            'sexo'=>'nullable|string|in:M,F',
            'edad'=>'nullable|integer|min:0',
        ];
    }
}
