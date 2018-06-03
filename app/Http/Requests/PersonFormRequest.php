<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonFormRequest extends FormRequest
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
            'tipo_persona' => 'max:20',
            'nombre' => 'required|max:100',
            'tipo_documento' => 'max:20|nullable',
            'num_documento'=> 'max:15|nullable',
            'direccion' => 'max:70|nullable',
            'telefono'=> 'max:15|nullable',
            'email' => 'max:50|nullable',
        ];
    }
}

