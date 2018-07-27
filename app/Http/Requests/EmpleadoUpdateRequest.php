<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoUpdateRequest extends FormRequest
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
        $rules = [
            'nombre' => 'required',
            'nrodocumento' => 'required|between:0,10|unique:empleados,nrodocumento,' . $this->empleado,
            'fechanacimiento' => 'required|date',
            'celular' => 'required|digits_between:6,15',
            'empresacelular_id' => 'required',
            'actividad_id' => 'required',
            'sexo' => 'required',
        ];

        if($this->get('email'))
            $rules = array_merge($rules, ['email' => 'required|email']);


        if($this->get('direccion'))
            $rules = array_merge($rules, ['direccion' => 'required|between:0,256']);
        
        return $rules;
    }
}
