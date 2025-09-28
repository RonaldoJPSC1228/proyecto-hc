<?php

namespace App\Http\Modules\Pacientes\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Paciente};
use Illuminate\Validation\Rules\Password;

class PacientesStoreRequest extends FormRequest
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
            'nombre' => 'required',
            'apellido' => 'required',
            'tipo_identificacion' => 'required',
            'numero_identificacion' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'telefono' => 'nullable',
            'email' => 'required',
            'tipo_afiliacion' => 'required',
            'num_historial_medico' => 'required',
            'pais' => 'required',
            'departamento' => 'required',
            'eps' => 'required',
            'ocupacion' => 'required',
            'discapacidad' => 'nullable',
            'subsidiaria' => 'nullable'
        ];
    }
}
