<?php

namespace App\Http\Modules\HistoriaClinica\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{HistoriaClinica};

class HistoriasCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new HistoriaClinica)->getTable();
        return [
            // Definir reglas de validación para el método Create

        ];
    }
}
