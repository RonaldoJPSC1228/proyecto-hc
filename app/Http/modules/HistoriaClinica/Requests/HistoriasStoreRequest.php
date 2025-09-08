<?php

namespace App\Http\Modules\HistoriaClinica\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{HistoriaClinica};
use Illuminate\Validation\Rules\Password;

class HistoriasStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new HistoriaClinica)->getTable();
        return [
            // Definir reglas de validación para el método Store
            'nombre'          => 'required',
            'apellido'        => 'required',
            'fecha_nacimiento' => 'required',
            'genero'          => 'required',
            'documento'       => "required",
            'telefono'        => 'nullable',
            'email'           => "required",
            'paciente_id'    => 'required',
            'evidencia'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }
}
