<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'nrodocumento' => 'required|between:0,10|unique:clientes,nrodocumento,' . $this->cliente,
            'fechanacimiento' => 'required|date',
            'celular' => 'required|digits_between:6,15',
            'empresacelular_id' => 'required',
            'sexo' => 'required',
            'estadocliente_id' => 'required',
        ];

        if($this->get('email'))
            $rules = array_merge($rules, ['email' => 'required|email']);

        if($this->get('celularemergencia'))
            $rules = array_merge($rules, ['celularemergencia' => 'required|digits_between:6,15']);

        if($this->get('telefonoemergencia'))
            $rules = array_merge($rules, ['telefonoemergencia' => 'required|digits_between:6,15']);

        if($this->get('motivo'))
            $rules = array_merge($rules, ['motivo' => 'required|between:0,200']);

        if($this->get('direccion'))
            $rules = array_merge($rules, ['direccion' => 'required|between:0,256']);
        
        
        if($this->get('image'))        
            $rules = array_merge($rules, ['image'         => 'mimes:jpg,jpeg,png']);

        return $rules;
    }
}
