<?php

namespace App\Http\Modules\HistoriaClinica\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{HistoriaClinica};

class HistoriasIndexRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $tabla =  (new HistoriaClinica)->getTable();
        return [
            // Definir reglas de validación para el método Index
        //   'filter_searchtxt' => 'nullable',
        //   'filter_first_name' => 'nullable',
        //   'filter_last_name' => 'nullable',
        //   'filter_email' => 'nullable',
        //   'filter_state' => 'nullable',

        ];
    }
}
