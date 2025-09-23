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
            'paciente_id' => 'required|exists:pacientes,id',
            'motivo_consulta' => 'required|string|max:1000',
            'antecedentes' => 'nullable|string|max:2000',
            'fecha' => 'required',
            'sintoma_1' => 'required',
            'sintoma_2' => 'nullable',
            'sintoma_3' => 'nullable',
            'diagnostico_presuntivo' => 'required|string|max:2000',
            'evidencias' => 'nullable',
        ];
    }
}
