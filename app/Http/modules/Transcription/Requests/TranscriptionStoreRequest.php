<?php

namespace App\Http\Modules\Transcription\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};
use Illuminate\Validation\Rules\Password;

class TranscriptionStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new Paciente)->getTable();
        return [
            // Definir reglas de validación para el método Store
            'nombre'          => 'required',
            'apellido'        => 'required',
            'fecha_nacimiento' => 'required',
            'genero'          => 'required',
            'documento'       => "required",
            'telefono'        => 'nullable',
            'email'           => "required",
        ];
    }
}
