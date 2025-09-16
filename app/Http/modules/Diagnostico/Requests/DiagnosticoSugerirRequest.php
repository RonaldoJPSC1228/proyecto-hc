<?php

namespace App\Http\Modules\Diagnostico\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticoSugerirRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia si quieres control de permisos
    }

    public function rules()
    {
        return [
            // 'motivo_consulta' => 'nullable|string|max:1000',
            // 'antecedentes' => 'nullable|string|max:2000',
            // 'sintomas' => 'required|string|max:2000',
            'motivo' => 'required|string|max:1000',
            'sintomas_1' => 'required|string|max:1000',
            'sintomas_2' => 'nullable|string|max:1000',
            'sintomas_3' => 'nullable|string|max:1000',
        ];
    }
}
