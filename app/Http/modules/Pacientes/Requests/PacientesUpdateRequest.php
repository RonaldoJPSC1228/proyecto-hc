<?php

namespace App\Http\Modules\Pacientes\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};
use Illuminate\Validation\Rules\Password;

class PacientesUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new Paciente)->getTable();
        return [
            // Definir reglas de validación para el método Update
  

        ];
    }
}
