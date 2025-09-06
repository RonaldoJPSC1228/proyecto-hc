<?php

namespace App\Http\Modules\Pacientes\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};

class PacientesDestroyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new Paciente)->getTable();
        return [
            // Definir reglas de validación para el método Destroy
        //   'id' => 'required|numeric|exists:'.$tabla.',id',

        ];
    }
}
